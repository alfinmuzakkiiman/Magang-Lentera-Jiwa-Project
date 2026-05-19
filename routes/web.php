<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PROTECTED (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function(){

    /*
    |--------------------------------------------------------------------------
    | PROFILE SETTINGS
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | REDIRECT ROOT
    |--------------------------------------------------------------------------
    */
    Route::get('/', function () {
        if (\Illuminate\Support\Facades\Auth::user()->role == 'kasir') {
            return redirect()->route('kasir.index');
        } elseif (\Illuminate\Support\Facades\Auth::user()->role == 'kitchen') {
            return redirect()->route('kitchen.index');
        }
        return redirect()->route('dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN (HARUS ROLE ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        
        // 1. Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    });

    /*
    |--------------------------------------------------------------------------
    | SHARED ADMIN & KITCHEN
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,kitchen')->group(function () {
        // 2. Menu Management
        Route::resource('menu', MenuController::class);

        // Kategori Management
        Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
    });

    Route::middleware('role:admin')->group(function () {

        // 3. Pendapatan (Riwayat Transaksi)
        Route::resource('pendapatan', PendapatanController::class)->only(['index', 'show']);

        // 4. Laporan Kasir
        Route::get('/admin/kasir', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.kasir.index');
        Route::post('/admin/kasir', [\App\Http\Controllers\UserController::class, 'store'])->name('admin.kasir.store');
        Route::put('/admin/kasir/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('admin.kasir.update');
        Route::delete('/admin/kasir/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('admin.kasir.destroy');
        
        // 5. Cetak Struk
        Route::get('/admin/struk/{id}', [\App\Http\Controllers\KasirController::class, 'struk'])->name('admin.struk');

    });

    /*
    |--------------------------------------------------------------------------
    | KASIR
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:kasir')->prefix('kasir')->name('kasir.')->group(function () {
        Route::get('/',              [KasirController::class, 'index'])->name('index');
        Route::post('/add/{id}',     [KasirController::class, 'add'])->name('add');
        Route::post('/update/{id}',  [KasirController::class, 'update'])->name('update');
        Route::delete('/remove/{id}',[KasirController::class, 'delete'])->name('remove');
        Route::post('/checkout',     [KasirController::class, 'checkout'])->name('checkout');
        Route::get('/struk/{id}',    [KasirController::class, 'struk'])->name('struk');
    });

    /*
    |--------------------------------------------------------------------------
    | KITCHEN
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:kitchen')->prefix('kitchen')->name('kitchen.')->group(function () {
        Route::get('/', [KitchenController::class, 'index'])->name('index');
        Route::post('/update/{id}', [KitchenController::class, 'updateStatus'])->name('update');
    });

});