@extends('layouts.app')

@section('content')
<h4>Edit Shoe</h4>
<div class="container mt-4 mb-5">
    <form action="{{ route('shoes.update', $shoe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="name">Shoe Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $shoe->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="price">Price (Rp)</label>
                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $shoe->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $shoe->stock) }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $shoe->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $shoe->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="cover">Shoe Image (Cover)</label>
            <input type="file" name="cover" id="cover" class="form-control @error('cover') is-invalid @enderror">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            
            @if ($shoe->cover)
                <div class="mt-3">
                    <label>Current Image:</label><br>
                    <img src="{{ asset('storage/' . $shoe->cover) }}" class="img-thumbnail" style="width: 150px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary me-2">Update Shoe</button>
        <a href="{{ route('shoes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection