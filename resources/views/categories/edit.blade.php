@extends('layouts.app')

@section('content')
<h4>Edit Category</h4>
<div class="container mt-5 mb-5">
    <form action="{{ route('categories.update',$category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$category->name) }}" >
     
     @error('name')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description',$category->description) }}</textarea>
    </div>

    <button type="submit" class="btn btn-md btn-primary me-3">Save</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
</div>
@endsection