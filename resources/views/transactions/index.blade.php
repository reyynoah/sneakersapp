@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Transactions List</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Incoming Orders
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Phone / WA</th>
                        <th>Address</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>#{{ $transaction->id }}</td>
                        
                        <td>
                            <span class="fw-bold">{{ $transaction->customer_name }}</span>
                            @if($transaction->customer_email)
                                <br><small class="text-muted">{{ $transaction->customer_email }}</small>
                            @endif
                        </td>
                        
                        <td>{{ $transaction->customer_phone }}</td>
                        
                        <td>{{ $transaction->customer_address }}</td>
                        
                        <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        
                        <td>
                            @if($transaction->status == 'paid')
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $transaction->status }}</span>
                            @endif
                        </td>
                        
                        <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection