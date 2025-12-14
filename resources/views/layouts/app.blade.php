<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakers Admin</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-bg: #1e1e2d;
            --sidebar-text: #9899ac;
            --sidebar-active: #3699ff;
            --bg-color: #f5f8fa;
            --card-shadow: 0px 0px 20px 0px rgba(76, 87, 125, 0.02);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: #3f4254;
            overflow-x: hidden;
            font-size: 0.9rem;
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            background-color: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .brand-logo {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 25px;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .menu-title {
            color: #5d5f75;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 20px 25px 10px;
        }
        .nav-link {
            color: var(--sidebar-text);
            padding: 12px 25px;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }
        .nav-link:hover {
            color: white;
            background-color: rgba(255,255,255,0.02);
        }
        .nav-link.active {
            color: white;
            background-color: #1b1b28;
            border-right: 3px solid var(--sidebar-active);
        }
        .nav-link i {
            width: 25px;
            font-size: 1.1rem;
            margin-right: 10px;
            color: #494b74;
            transition: color 0.2s;
        }
        .nav-link.active i, .nav-link:hover i {
            color: var(--sidebar-active);
        }
        .main-wrapper {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            background: white;
        }
        .user-profile-img {
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
        }
    </style>
</head>
<body>

<nav class="sidebar">
    <div class="brand-logo">
        <i class=></i> SNEAKERS<span class=>APP</span>
    </div>

    <div class="sidebar-menu mt-2">
        @auth
        <div class="menu-title">Main Menu</div>
        
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('shoes.index') }}" class="nav-link {{ request()->routeIs('shoes.*') ? 'active' : '' }}">
            <i class="fa-solid fa-box-open"></i>
            <span>Products</span>
        </a>

        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="fa-solid fa-tags"></i>
            <span>Categories</span>
        </a>

        <div class="menu-title">Finance</div>

        <a href="{{ route('transactions.index') }}" class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            <span>Transactions</span>
        </a>
        @endauth
        
        </div>
</nav>

<div class="main-wrapper">
    
    <nav class="navbar navbar-expand bg-white shadow-sm mb-4 rounded-3 p-3">
        <div class="container-fluid px-0">
            
            <div class="d-flex flex-column">
                <h5 class="fw-bold m-0 text-dark">
                    @if(request()->routeIs('shoes.*')) 
                        <i class="fa-solid fa-box me-2 text-primary"></i>Product Management
                    @elseif(request()->routeIs('categories.*')) 
                        <i class="fa-solid fa-tags me-2 text-warning"></i>Categories
                    @elseif(request()->routeIs('transactions.*')) 
                        <i class="fa-solid fa-file-invoice-dollar me-2 text-success"></i>Transaction History
                    @elseif(request()->routeIs('dashboard')) 
                        <i class="fa-solid fa-chart-line me-2 text-info"></i>Dashboard
                    @else 
                        Application
                    @endif
                </h5>
                <small class="text-muted" style="font-size: 12px;">Sneakers Store Admin Panel</small>
            </div>

            @auth
            <div class="ms-auto d-flex align-items-center">
                <div class="text-end me-3 d-none d-md-block">
                    <div class="fw-bold text-dark small">{{ Auth::user()->name }}</div>
                    <div class="text-muted" style="font-size: 10px;">Administrator</div>
                </div>
                
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=EBF4FF&color=3699FF&bold=true" 
                             class="rounded-circle user-profile-img" 
                             width="42" height="42" alt="User">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 mt-2" style="min-width: 200px;">
                        <li class="px-3 py-2 border-bottom mb-2">
                            <span class="fw-bold d-block">{{ Auth::user()->name }}</span>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item rounded text-danger py-2">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i> Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endauth
        </div>
    </nav>

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>