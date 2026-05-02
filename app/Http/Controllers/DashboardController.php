<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pendapatan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenu = Menu::count();
        $totalPendapatan = Pendapatan::whereDate('created_at', today())->sum('total');
        $totalOrder = Pendapatan::whereDate('created_at', today())->count();
        $totalKasir = \App\Models\User::where('role', 'kasir')->count();

        return view('dashboard.dashboard', compact(
            'totalMenu',
            'totalPendapatan',
            'totalOrder',
            'totalKasir'
        ));
    }
}
