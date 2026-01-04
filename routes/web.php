<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.proses'); // Tambahkan .proses
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.proses');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'role:1'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [ProdukController::class, 'index'])->name('dashboard');

        Route::resource('/kategori', KategoriController::class);
        Route::resource('/produk', ProdukController::class);
        
        Route::get('/pesanan', [OrderController::class, 'indexAdmin'])->name('pesanan.index');
    });

    // Route::middleware('role:1')->prefix('admin')->name('admin.')->group(function () {
    //     Route::get('/dashboard', function () {
    //         return view('pages.admin.dashboard');
    //     })->name('dashboard');

    //     Route::resource('/kategori', KategoriController::class);
    //     Route::resource('/produk', ProdukController::class);
    // });

    Route::middleware('role:2')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [ProdukController::class, 'indexUser'])->name('dashboard');
        Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
        Route::post('/keranjang/add/{id}', [KeranjangController::class, 'add'])->name('keranjang.add');
        Route::get('/pembayaran', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('/pembayaran/proses', [OrderController::class, 'proses'])->name('checkout.proses');
    });
});