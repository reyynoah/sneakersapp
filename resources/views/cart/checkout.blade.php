@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Checkout Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-light border mb-4">
                        <strong>Total Payment:</strong> 
                        <span class="text-primary fw-bold fs-5">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('cart.process') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="customer_name" class="form-control" required placeholder="John Doe">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone / WhatsApp</label>
                                <input type="text" name="customer_phone" class="form-control" required placeholder="0812...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email (Optional)</label>
                                <input type="email" name="customer_email" class="form-control" placeholder="john@example.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Shipping Address</label>
                            <textarea name="customer_address" rows="3" class="form-control" required placeholder="Street, City, Postcode"></textarea>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-dark py-2">
                                <i class="fa-solid fa-paper-plane me-2"></i> Confirm Order
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection