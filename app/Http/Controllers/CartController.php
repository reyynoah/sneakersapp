<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shoe_id' => 'required|exists:shoes,id', // Ganti book_id
            'quantity' => 'required|integer|min:1',
        ]);

        // Set user_id to a static number (e.g., 1)
        $cart = Cart::create([
            'user_id' => 1, // Static user_id
            'shoe_id' => $validatedData['shoe_id'], // Ganti book_id
            'quantity' => $validatedData['quantity'],
        ]);

        return redirect()->route('cart.index')->with('success', 'Shoe added to cart.');
    }

    public function index()
    {
        // Ganti 'book' jadi 'shoe'
        $carts = Cart::with('shoe')->where('user_id', 1)->get(); // Static user_id
        return view('cart.index', compact('carts'));
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', 1)->firstOrFail();
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}