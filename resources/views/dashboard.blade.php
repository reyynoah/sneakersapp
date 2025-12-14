@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark">Dashboard</h3>
            <p class="text-muted mb-0">Welcome back, {{ Auth::user()->name }}!</p>
        </div>
        <div>
            <span class="text-muted small">{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <div class="row g-3 mb-4">
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase small fw-bold mb-1">Total Products</h6>
                            <h2 class="fw-bold text-dark mb-0">{{ $totalShoes ?? 0 }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded">
                            <i class="fa-solid fa-box fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase small fw-bold mb-1">Categories</h6>
                            <h2 class="fw-bold text-dark mb-0">{{ $totalCategories ?? 0 }}</h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 text-warning p-3 rounded">
                            <i class="fa-solid fa-tags fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase small fw-bold mb-1">Total Orders</h6>
                            <h2 class="fw-bold text-dark mb-0">{{ $totalTransactions ?? 0 }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 text-success p-3 rounded">
                            <i class="fa-solid fa-receipt fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="fw-bold m-0">Latest Added Products</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase">
                        <tr>
                            <th class="ps-4 py-3 border-0">Product Name</th>
                            <th class="py-3 border-0">Category</th>
                            <th class="py-3 border-0">Price</th>
                            <th class="py-3 border-0">Stock Status</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse($latestShoes ?? [] as $shoe)
    <tr>
        <td class="ps-4 py-3">
            <div class="d-flex align-items-center">
                @if($shoe->cover)
                    <img src="{{ asset('storage/' . $shoe->cover) }}" 
                         class="rounded me-3 border" 
                         width="48" height="48" 
                         style="object-fit: cover;" 
                         alt="{{ $shoe->name }}">
                @else
                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center border" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-image text-secondary"></i>
                    </div>
                @endif
                
                <div>
                    <div class="fw-bold text-dark">{{ $shoe->name }}</div>
                    <small class="text-muted">ID: #{{ $shoe->id }}</small>
                </div>
            </div>
        </td>
        <td>
            <span class="badge bg-light text-dark border">
                {{ $shoe->category->name ?? 'Uncategorized' }}
            </span>
        </td>
        <td class="fw-bold">
            Rp {{ number_format($shoe->price, 0, ',', '.') }}
        </td>
        <td>
            @if($shoe->stock > 0)
                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">
                    In Stock ({{ $shoe->stock }})
                </span>
            @else
                <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1">
                    Out of Stock
                </span>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="text-center py-5 text-muted">
            <div class="d-flex flex-column align-items-center">
                <i class="fa-solid fa-box-open fa-3x mb-3 text-light"></i>
                <span>No products found.</span>
            </div>
        </td>
    </tr>
    @endforelse
</tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 text-center">
            <a href="{{ route('shoes.index') }}" class="btn btn-sm btn-outline-primary">
                View All Inventory
            </a>
        </div>
    </div>

</div>
@endsection