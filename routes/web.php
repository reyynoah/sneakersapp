<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController; // <--- 1. Tambahkan baris ini di paling atas

Route::get('/', function () {
    return view('welcome');
});

// 2. Tambahkan baris ini di paling bawah
Route::resource('categories', CategoryController::class);