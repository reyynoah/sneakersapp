@extends('layouts.app')

@section('content')
<h4>List Categories</h4>
<a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">Add Category</a>
<br/><br />

@include('layouts.alert')

<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                <a href="{{ route('categories.show',$category->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form onsubmit="return confirm('Apakah anda yakin ?');" action="{{ route('categories.destroy',$category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
            <div class="alert alert-info">
                data masih kosong.
            </div>
        @endforelse
    </tbody>
</table>
@endsection