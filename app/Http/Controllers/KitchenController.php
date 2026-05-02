<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function index()
    {
        $orders = Pendapatan::with('details')->latest()->get();
        return view('kitchen.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Pendapatan::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back();
    }
}
