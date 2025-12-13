@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h4 class="mb-4">Shoes Collection</h4>
    @include('layouts.alert')
    
    <form action="{{ route('welcome') }}" method="GET" class="mb-4">
        <div class="input-group" style="max-width:720px;">
            <input
                type="text"
                name="search"
                placeholder="Search shoes by name..."
                value="{{ $search ?? '' }}"
                class="form-control"
            >
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
                <div class="card h-100 shadow-sm">
                    @if ($shoe->cover)
                        <img src="{{ asset('storage/' . $shoe->cover) }}" class="card-img-top img-fluid" alt="Cover Image">
                    @else
                        <img src="https://via.placeholder.com/400x600?text=No+Cover" class="card-img-top img-fluid" alt="No Cover">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $shoe->name }}</h5>
                        <p class="card-text text-muted mb-2">Rp {{ number_format($shoe->price, 0, ',', '.') }}</p>
                        <p class="card-text mb-3">{{ \Illuminate\Support\Str::limit($shoe->description, 80) }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('shoes.showuser', $shoe->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection