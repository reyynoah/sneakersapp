@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h4 class="mb-3">Category Details</h4>
    @include('layouts.alert')
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <hr>
                    <p class="card-text">{{ $category->description ?? '-' }}</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-secondary">Back</a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-muted small">
                <span>Created: {{ $category->created_at ? \Carbon\Carbon::parse($category->created_at)->diffForHumans() : '-' }}</span>
            </div>
        </div>
    </div>
</div>
@endsection