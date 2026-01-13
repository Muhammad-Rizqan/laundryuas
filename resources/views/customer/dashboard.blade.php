<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - LaundryKita</title>

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
        .sidebar .nav-link {
            color: white;
            padding: 0.8rem 1.2rem;
            border-radius: 8px;
            transition: 0.3s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active { background: rgba(255,255,255,0.15); }
        .card-stat {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card-stat:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
        }
        .status-badge {
            padding: 0.5em 1em;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .status-pending { background: #ffc107; color: #212529; }
        .status-processing { background: #0dcaf0; color: white; }
        .status-done { background: #198754; color: white; }
        .status-delivered { background: #6610f2; color: white; }
        .empty-state { padding: 6rem 1rem; text-align: center; color: #6c757d; }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar col-md-2 d-none d-md-block">
        <div class="text-center mb-5">
            <h4 class="fw-bold">LaundryKita</h4>
            <small class="opacity-75">Dashboard Pelanggan</small>
        </div>

        <ul class="nav flex-column gap-2">
            <li class="nav-item">
                <a href="{{ route('customer.dashboard') }}" class="nav-link active d-flex align-items-center">
                    <i class="fas fa-home me-3"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customer.order.create') }}" class="nav-link d-flex align-items-center">
                    <i class="fas fa-plus-circle me-3"></i> Pesan Baru
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="fas fa-bell me-3"></i> Notifikasi
                </a>
            </li>
        </ul>

        <hr class="bg-white opacity-50 my-4">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center">
                <i class="fas fa-sign-out-alt me-2"></i> Keluar
            </button>
        </form>
    </div>

    <!-- Konten Utama -->
    <main class="flex-grow-1 p-4 p-md-5">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
            <div>
                <h1 class="h3 mb-1">Halo, {{ auth()->user()->name }}</h1>
                <p class="text-muted mb-0">Selamat datang kembali di LaundryKita!</p>
            </div>
            <a href="{{ route('customer.order.create') }}" class="btn btn-primary d-flex align-items-center px-4 py-2">
                <i class="fas fa-plus me-2"></i> Pesan Laundry Baru
            </a>
        </div>

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistik -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card card-stat bg-primary text-white shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-shopping-bag fa-2x mb-2"></i>
                        <h6 class="opacity-75 mb-1">Total Pesanan</h6>
                        <h3 class="mb-0">{{ $totalOrders ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stat bg-warning text-dark shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-clock fa-2x mb-2"></i>
                        <h6 class="opacity-75 mb-1">Pending</h6>
                        <h3 class="mb-0">{{ $pendingOrders ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stat bg-success text-white shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                        <h6 class="opacity-75 mb-1">Selesai</h6>
                        <h3 class="mb-0">{{ $completedOrders ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pesanan -->
        <div class="card shadow border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Riwayat Pesanan</h5>

                <!-- Filter Status -->
                <form method="GET" class="mb-0">
                    <select name="status" class="form-select form-select-sm w-auto d-inline" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Selesai</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Terkirim</option>
                    </select>
                </form>
            </div>

            <div class="card-body p-0">
                @if ($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">#</th>
                                    <th>Paket</th>
                                    <th class="text-end">Berat</th>
                                    <th class="text-end">Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="ps-4">{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                        <td>{{ $order->package->name }}</td>
                                        <td class="text-end">{{ number_format($order->weight, 1) }} kg</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($order->total_price) }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $order->status }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detail{{ $order->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Detail Pesanan -->
                                    <div class="modal fade" id="detail{{ $order->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Pesanan #{{ $order->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <strong>Paket</strong>
                                                            <span>{{ $order->package->name }}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <strong>Berat</strong>
                                                            <span>{{ number_format($order->weight, 1) }} kg</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <strong>Total Harga</strong>
                                                            <span class="fw-bold">Rp {{ number_format($order->total_price) }}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <strong>Status</strong>
                                                            <span class="badge status-{{ $order->status }} px-3 py-2">{{ ucfirst($order->status) }}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between">
                                                            <strong>Tanggal Pesan</strong>
                                                            <span>{{ $order->created_at->format('d F Y H:i') }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-box-open fa-5x mb-4 text-muted"></i>
                        <h5>Belum ada pesanan</h5>
                        <p class="mb-4">Mulai pesan laundry sekarang dan dapatkan layanan terbaik!</p>
                        <a href="{{ route('customer.order.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Pesan Sekarang
                        </a>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if ($orders->hasPages())
                <div class="card-footer bg-white text-center border-0">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>