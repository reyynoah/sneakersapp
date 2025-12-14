<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [ShoeController::class, 'welcome'])->name('welcome');
Route::get('/product/{id}', [ShoeController::class, 'showUser'])->name('shoes.showuser');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/', [CartController::class, 'store'])->name('store');
    Route::delete('/{id}', [CartController::class, 'destroy'])->name('destroy');
});

Route::get('/checkout', [CartController::class, 'checkoutForm'])->name('cart.checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.process');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('shoes', ShoeController::class);
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
});