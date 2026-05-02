<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal', today()->toDateString());

        $data = Pendapatan::with('details.menu')
            ->whereDate('created_at', $tanggal)
            ->latest()
            ->get();
            
        $grandTotal = $data->sum('total');

        return view('pendapatan.index', compact('data', 'grandTotal', 'tanggal'));
    }

    public function show($id)
    {
        $data = Pendapatan::findOrFail($id);
        return response()->json($data);
    }
}