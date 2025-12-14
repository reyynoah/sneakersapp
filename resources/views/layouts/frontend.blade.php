<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SneakersApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
        .navbar-brand { font-weight: 700; letter-spacing: 0.5px; font-size: 1.5rem; }
        .nav-link { font-weight: 500; color: #555; }
        .nav-link:hover { color: #000; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand text-dark d-flex align-items-center gap-2" href="{{ route('welcome') }}">
                <span>SNEAKERS<span class="text-primary">APP</span></span>
            </a>
            
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('cart.index') }}" class="btn btn-light border position-relative">
                    <i class="fa-solid fa-cart-shopping text-secondary"></i>
                    @if(\App\Models\Cart::where('user_id', 1)->count() > 0)
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <div style="min-height: 80vh;">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>