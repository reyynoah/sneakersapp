<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return redirect()->route('login'); 
});

// Route Halaman Depan
Route::get('/', [ShoeController::class, 'welcome'])->name('welcome');
Route::get('/shoes/user/{id}', [ShoeController::class, 'showUser'])->name('shoes.showuser');

// Cart Routes (No Authentication Required - Sesuai Materi)
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// ... (Sisa route Auth dan Resource biarkan di bawah) ...

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('shoes', ShoeController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('shoes', ShoeController::class);
    Route::resource('categories', CategoryController::class);
    
    // Route buat Admin lihat Transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
});
