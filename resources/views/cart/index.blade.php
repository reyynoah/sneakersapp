@extends('layouts.frontend')

@section('content')
<div class="container my-4">
    <h4 class="mb-3">Your Cart</h4>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($carts->isEmpty())
        <div class="alert alert-info">Your cart is empty.</div>
        <a href="{{ route('welcome') }}" class="btn btn-sm btn-secondary">Start Shopping</a>
    @else
        <div class="table-responsive mb-3">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product Details</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach ($carts as $cart)
                        @php 
                            $subtotal = $cart->shoe->price * $cart->quantity;
                            $grandTotal += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($cart->shoe->cover)
                                        <img src="{{ asset('storage/' . $cart->shoe->cover) }}" width="60" height="60" class="rounded me-3 border object-fit-cover">
                                    @else
                                        <div class="bg-light rounded me-3 border d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                            <i class="fa-solid fa-shoe-prints text-secondary"></i>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <div class="fw-bold">{{ $cart->shoe->name }}</div>
                                        <div class="badge bg-secondary">Size: {{ $cart->size }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">Rp {{ number_format($cart->shoe->price, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $cart->quantity }}</td>
                            <td class="text-center">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this item?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end align-items-center gap-3">
            <div>
                <strong>Total Payment:</strong> 
                <span class="fs-4 text-primary fw-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>
            
            <a href="{{ route('welcome') }}" class="btn btn-sm btn-secondary">Continue Shopping</a>
            <a href="{{ route('cart.checkout') }}" class="btn btn-sm btn-success px-4">
                Checkout <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>
    @endif
</div>
@endsection