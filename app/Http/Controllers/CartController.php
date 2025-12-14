<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Shoe;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shoe_id' => 'required|exists:shoes,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required', 
        ]);
        Cart::create([
            'user_id' => 1, 
            'shoe_id' => $validatedData['shoe_id'],
            'quantity' => $validatedData['quantity'],
            'size' => $validatedData['size'], 
        ]);
        return redirect()->route('cart.index')->with('success', 'Shoe added to cart.');
    }

    public function index()
    {
        $carts = Cart::with('shoe')->where('user_id', 1)->get(); 
        return view('cart.index', compact('carts'));
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', 1)->firstOrFail();
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function checkoutForm()
    {
        $carts = Cart::with('shoe')->where('user_id', 1)->get();
        if($carts->isEmpty()) {
            return redirect()->route('welcome');
        }
        $total = 0;
        foreach($carts as $cart) {
            $total += $cart->shoe->price * $cart->quantity;
        }
        return view('cart.checkout', compact('carts', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
        ]);
        $carts = Cart::with('shoe')->where('user_id', 1)->get();
        if($carts->isEmpty()) {
            return redirect()->route('welcome');
        }
        $totalPrice = 0;
        foreach ($carts as $cart) {
            if ($cart->shoe->stock < $cart->quantity) {
                 return redirect()->back()->with('error', 'Stok habis untuk ' . $cart->shoe->name);
            }
            $totalPrice += $cart->shoe->price * $cart->quantity;
        }
        Transaction::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_price' => $totalPrice,
            'status' => 'paid',
        ]);
        foreach ($carts as $cart) {
            $shoe = Shoe::find($cart->shoe_id);
            $shoe->decrement('stock', $cart->quantity);
            $cart->delete();
        }

        return redirect()->route('welcome')->with('success', 'Thank you! Your order has been placed.');
    }
}