<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\ShoeController;

Route::get('/', function () {
    return view('welcome');
});

// categories
Route::resource('categories', CategoryController::class);

// shoes
Route::resource('shoes', ShoeController::class);

