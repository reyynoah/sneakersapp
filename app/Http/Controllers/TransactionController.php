<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan halaman list transaksi untuk Admin
    public function index()
    {
        // Ambil data transaksi terbaru, beserta data user dan sepatunya
        $transactions = Transaction::with(['user', 'shoe'])->latest()->get();
        return view('transactions.index', compact('transactions'));
    }
}