<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;       
use App\Models\Category;  
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalShoes = Shoe::count();
        $totalCategories = Category::count();
        $totalTransactions = Transaction::count();
        $latestShoes = Shoe::with('category')->latest()->take(5)->get();
        return view('dashboard', compact('totalShoes', 'totalCategories', 'totalTransactions', 'latestShoes'));
    }
}