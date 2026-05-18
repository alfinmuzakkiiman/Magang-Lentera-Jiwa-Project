<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->get();
        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('menu.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_menu' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048'
        ]);

        // upload gambar (optional)
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        Menu::create($data);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kategoris = \App\Models\Kategori::all();
        return view('menu.edit', compact('menu', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $data = $request->validate([
            'nama_menu' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048'
        ]);

        // upload gambar baru
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        $menu->update($data);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil diupdate');
    }

    public function destroy($id)
    {
        Menu::destroy($id);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil dihapus');
    }
}