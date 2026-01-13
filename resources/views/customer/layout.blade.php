<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LaundryKita</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            background: linear-gradient(180deg, #0d6efd 0%, #0b5ed7 100%);
            min-height: 100vh;
            color: white;
            padding: 2rem 1rem;
        }
        .sidebar .nav-link { color: white; padding: 0.8rem 1rem; border-radius: 8px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.15); }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar Customer -->
    <div class="sidebar col-md-2 d-none d-md-block">
        <h4 class="text-center mb-5">LaundryKita</h4>

        <ul class="nav flex-column gap-2">
            <li><a href="{{ route('customer.dashboard') }}" class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home me-2"></i> Dashboard</a></li>
            <li><a href="{{ route('customer.order.create') }}" class="nav-link {{ request()->routeIs('customer.order.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle me-2"></i> Pesan Baru</a></li>
        </ul>

        <hr class="bg-white my-4">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100">
                <i class="fas fa-sign-out-alt me-2"></i> Keluar
            </button>
        </form>
    </div>

    <!-- Konten Utama -->
    <main class="flex-grow-1 p-4 p-md-5">
        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ada kesalahan!</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Konten halaman child -->
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>