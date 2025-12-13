@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h4 class="mb-3">Your Cart</h4>
    @include('layouts.alert')
    
    @if ($carts->isEmpty())
        <div class="alert alert-info">Your cart is empty.</div>
    @else
        <div class="table-responsive mb-3">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Shoe</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalQty = 0; @endphp
                    @foreach ($carts as $cart)
                        @php $totalQty += $cart->quantity; @endphp
                        <tr>
                            <td>{{ $cart->shoe->name }}</td>
                            <td class="text-center">{{ $cart->quantity }}</td>
                            <td class="text-center">
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this item from cart?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end align-items-center gap-3">
            <div>
                <strong>Total Qty:</strong>
                <span class="fs-5">{{ $totalQty }}</span>
            </div>
            <a href="{{ route('welcome') }}" class="btn btn-sm btn-secondary">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection