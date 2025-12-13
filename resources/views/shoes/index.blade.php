@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h4 class="mb-3">List Shoes</h4>
    
    @include('layouts.alert')
    
    <a href="{{ route('shoes.create') }}" class="btn btn-sm btn-primary mb-3">Add Shoe</a>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($shoes as $shoe)
            <tr>
                <td>{{ $shoe->name }}</td>
                <td>{{ $shoe->category->name }}</td>
                <td>Rp {{ number_format($shoe->price, 0, ',', '.') }}</td>
                <td>{{ $shoe->stock }}</td>
                <td>
                    <a href="{{ route('shoes.show', $shoe->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('shoes.edit', $shoe->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('shoes.destroy', $shoe->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah anda yakin mau menghapus sepatu ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">
                    <div class="alert alert-info mb-0">
                        Data sepatu masih kosong.
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection