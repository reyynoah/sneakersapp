@extends('layouts.frontend')

@section('content')
<div class="container my-5">
    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary mb-3 rounded-pill">
        <i class="fa-solid fa-arrow-left me-2"></i> Back to Catalog
    </a>

    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                @if ($shoe->cover)
                    <img src="{{ asset('storage/' . $shoe->cover) }}" class="img-fluid w-100" alt="{{ $shoe->name }}">
                @else
                    <img src="https://via.placeholder.com/600x600?text=No+Image" class="img-fluid w-100" alt="No Image">
                @endif
            </div>
        </div>

        <div class="col-md-7">
            <div class="ps-lg-4">
                <h2 class="fw-bold text-dark mb-2">{{ $shoe->name }}</h2>
                <p class="text-muted mb-3">{{ $shoe->category->name ?? 'Sneakers' }}</p>
                
                <h3 class="text-primary fw-bold mb-4">Rp {{ number_format($shoe->price, 0, ',', '.') }}</h3>

                <div class="mb-4 p-3 bg-light rounded">
                    <h6 class="fw-bold">Description</h6>
                    <p class="text-secondary mb-0" style="line-height: 1.6;">{{ $shoe->description }}</p>
                </div>

                <p class="fw-bold {{ $shoe->stock > 0 ? 'text-success' : 'text-danger' }}">
                    <i class="fa-solid fa-box me-1"></i> Stock: {{ $shoe->stock }} pairs left
                </p>

                <hr>

                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="shoe_id" value="{{ $shoe->id }}">
                    
                    <div class="row mb-4">
                        <div class="col-6 col-md-5">
                            <label class="form-label fw-bold">Select Size</label>
                            <select name="size" class="form-select" required>
                                <option value="" selected disabled>Choose Size...</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                            </select>
                        </div>

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-bold">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $shoe->stock }}" class="form-control">
                        </div>
                    </div>

                    @if($shoe->stock > 0)
                        <button type="submit" class="btn btn-dark w-100 py-3 rounded-pill fw-bold">
                            <i class="fa-solid fa-cart-plus me-2"></i> Add to Cart
                        </button>
                    @else
                        <button type="button" class="btn btn-secondary w-100 py-3 rounded-pill" disabled>
                            Out of Stock
                        </button>
                    @endif
                </form>

            </div>
        </div>
    </div>
</div>
@endsection