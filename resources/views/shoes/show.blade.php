@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>{{ $shoe->name }}</h4>
        <a href="{{ route('shoes.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
    </div>

    @include('layouts.alert')

    <div class="row">
        <div class="col-md-5 mb-3">
            <div class="card shadow-sm">
                @if ($shoe->cover)
                    <img src="{{ asset('storage/' . $shoe->cover) }}" class="card-img-top img-fluid" alt="{{ $shoe->name }}">
                @else
                    <img src="https://via.placeholder.com/400x400?text=No+Image" class="card-img-top img-fluid" alt="No Image">
                @endif
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">Price: Rp {{ number_format($shoe->price, 0, ',', '.') }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Stock: {{ $shoe->stock }} pairs</h6>
                    <hr>
                    
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">
                            <strong>Category:</strong> {{ $shoe->category->name ?? '-' }}
                        </li>
                    </ul>

                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p class="mt-2 text-secondary">{{ $shoe->description ?? 'No description available.' }}</p>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('shoes.edit', $shoe->id) }}" class="btn btn-warning">Edit</a>
                        
                        <form action="{{ route('shoes.destroy', $shoe->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="text-muted small mt-2">
                Created: {{ $shoe->created_at ? $shoe->created_at->diffForHumans() : '-' }}
            </div>
        </div>
    </div>
</div>
@endsection