<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pendapatan;
use App\Models\DetailPendapatan;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    /**
     * Tampilkan halaman kasir (menu + cart)
     */
    public function index()
    {
        $menus = Menu::all();
        $cart = session()->get('cart', []);

        // Buat dan simpan kode pesanan sementara ke session jika belum ada
        if (!session()->has('kode_pesanan')) {
            session()->put('kode_pesanan', '#' . mt_rand(100000, 999999));
        }
        $kode_pesanan = session()->get('kode_pesanan');

        // Hitung total cart
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['harga'] * $item['qty'];
        }

        $pajak = round($subtotal * 0.11);
        $total = $subtotal + $pajak;

        return view('kasir.index', compact('menus', 'cart', 'subtotal', 'pajak', 'total', 'kode_pesanan'));
    }

    /**
     * Tambah menu ke cart
     */
    public function add($id)
    {
        $menu = Menu::findOrFail($id);
        $cart = session()->get('cart', []);

        $currentQty = isset($cart[$id]) ? $cart[$id]['qty'] : 0;
        if ($currentQty >= $menu->stock) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'nama'   => $menu->nama_menu,
                'harga'  => $menu->harga,
                'gambar' => $menu->gambar,
                'qty'    => 1
            ];
        }

        session()->put('cart', $cart);

        return back();
    }

    /**
     * Update qty (plus / minus)
     */
    public function update($id, Request $request)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back();
        }

        if ($request->type == 'plus') {
            $menu = Menu::findOrFail($id);
            if ($cart[$id]['qty'] >= $menu->stock) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }
            $cart[$id]['qty']++;
        } else {
            $cart[$id]['qty']--;
            if ($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return back();
    }

    /**
     * Hapus item dari cart
     */
    public function delete($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back();
    }

    /**
     * Checkout: simpan transaksi → hapus cart → redirect ke struk
     */
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        // Hitung total
        $subtotal = 0;
        $totalItem = 0;

        foreach ($cart as $item) {
            $subtotal += $item['harga'] * $item['qty'];
            $totalItem += $item['qty'];
        }

        $pajak = round($subtotal * 0.11);
        $total = $subtotal + $pajak;

        // Ambil kode pesanan dari session
        $kodePesanan = session()->get('kode_pesanan', '#' . mt_rand(100000, 999999));
        $namaKasir = \Illuminate\Support\Facades\Auth::user()->name;
        $namaPelanggan = $request->nama_pelanggan ?? 'Umum';

        $cash = $request->cash ? (int) str_replace(',', '', $request->cash) : $total;
        $kembalian = $cash - $total;

        // 1. Simpan ke tabel orders
        $order = Order::create([
            'kode_pesanan'   => $kodePesanan,
            'nama_kasir'     => $namaKasir,
            'nama_pelanggan' => $namaPelanggan,
            'total'          => $total,
        ]);

        // 2. Simpan detail ke tabel order_items
        foreach ($cart as $menuId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id'  => $menuId,
                'qty'      => $item['qty'],
                'harga'    => $item['harga'],
                'subtotal' => $item['harga'] * $item['qty'],
            ]);

            // Kurangi stok menu
            $menu = Menu::find($menuId);
            if ($menu) {
                $menu->decrement('stock', $item['qty']);
            }
        }

        // 3. Simpan ke tabel pendapatans
        $trx = Pendapatan::create([
            'kode_pesanan'   => $kodePesanan,
            'nama_kasir'     => $namaKasir,
            'nama_pelanggan' => $namaPelanggan,
            'item'           => $totalItem,
            'total'          => $total,
            'cash'           => $cash,
            'kembalian'      => $kembalian,
            'status'         => 'Waiting',
        ]);

        // 4. Simpan detail ke tabel detail_pendapatans
        foreach ($cart as $menuId => $item) {
            DetailPendapatan::create([
                'pendapatan_id' => $trx->id,
                'menu_id'       => $menuId,
                'qty'           => $item['qty'],
                'harga'         => $item['harga'],
                'subtotal'      => $item['harga'] * $item['qty'],
            ]);
        }

        // 5. Hapus cart & kode pesanan
        session()->forget('cart');
        session()->forget('kode_pesanan');

        // 6. Redirect ke halaman struk
        return redirect()->route('kasir.struk', $trx->id);
    }

    /**
     * Tampilkan struk transaksi (auto print)
     */
    public function struk($id)
    {
        $trx = Pendapatan::with('details.menu')->findOrFail($id);

        return view('kasir.struk', compact('trx'));
    }
}