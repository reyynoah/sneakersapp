@extends('layouts.frontend')

@section('content')
<div class="container my-4">
    <h4 class="mb-4">Shoes Catalog</h4>

    <form action="{{ route('welcome') }}" method="GET" class="mb-4">
        <div class="input-group" style="max-width:720px;">
            <input type="text" name="search" placeholder="Search shoes by name..." value="{{ $search ?? '' }}" class="form-control">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    @if ($shoes->isEmpty())
        <div class="alert alert-warning d-flex justify-content-between align-items-center" role="alert">
            <div>
                <strong>No results found!</strong>
                <div>Please try a different search term.</div>
            </div>
            <button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.remove()"></button>
        </div>
    @endif

    <div class="row g-4">
        @foreach ($shoes as $shoe)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0 position-relative">
                
                @if($shoe->stock <= 0)
                    <div class="position-absolute top-0 end-0 m-2 badge bg-danger text-white px-3 py-2 shadow-sm" style="z-index: 10;">
                        SOLD OUT
                    </div>
                @endif

                @if ($shoe->cover)
                    <img src="{{ asset('storage/' . $shoe->cover) }}" class="card-img-top img-fluid" alt="{{ $shoe->name }}" style="height: 200px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/400x300?text=No+Image" class="card-img-top img-fluid" alt="No Cover">
                @endif
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-truncate">{{ $shoe->name }}</h5>
                    <p class="card-text text-primary fw-bold mb-2">Rp {{ number_format($shoe->price, 0, ',', '.') }}</p>
                    
                    <p class="small text-muted mb-2">
                        Stock: {{ $shoe->stock > 0 ? $shoe->stock : 'Habis' }}
                    </p>

                    <p class="card-text mb-3 small text-muted">{{ \Illuminate\Support\Str::limit($shoe->description, 60) }}</p>
                    
                    <div class="mt-auto">
                        @if($shoe->stock > 0)
                            <a href="{{ route('shoes.showuser', $shoe->id) }}" class="btn btn-sm btn-primary w-100">
                                Detail
                            </a>
                        @else
                            <button class="btn btn-sm btn-secondary w-100" disabled>
                                Out of Stock
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection