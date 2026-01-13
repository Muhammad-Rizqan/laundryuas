<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Laundry Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Optional: Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #0d6efd;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar .active {
            background-color: #0b5ed7;
        }
        .content-area {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar col-3 col-md-2 p-3">
        <h4 class="text-center mb-4">Laundry Admin</h4>
        <hr class="bg-white">
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}" href="{{ route('admin.packages.index') }}">
                    <i class="fas fa-box me-2"></i> Paket Laundry
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-shopping-cart me-2"></i> Order
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
                    <i class="fas fa-users me-2"></i> Customer
                </a>
            </li>
        </ul>

        <hr class="bg-white mt-4">

        <form action="{{ route('logout') }}" method="POST" class="d-grid">
            @csrf
            <button type="submit" class="btn btn-outline-light">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="content-area flex-grow-1">
        <!-- Navbar atas -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarContent">
                    <span class="navbar-text">
                        Selamat datang, <strong>{{ auth()->user()->name }}</strong>
                    </span>
                </div>
            </div>
        </nav>

        <!-- Konten utama -->
        <main class="p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>