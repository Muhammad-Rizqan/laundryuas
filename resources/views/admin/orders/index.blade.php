

@extends('layouts.admin') <!-- Asumsi kamu sudah punya layout admin -->

@section('title', 'Daftar Pesanan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Manajemen Pesanan</h2>
        <span class="badge bg-info fs-6">Total Pesanan: {{ $orders->total() }}</span>
    </div>

    <!-- Card Wrapper untuk tampilan lebih rapi -->
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pesanan Laundry</h5>
            <small>Menampilkan {{ $orders->count() }} dari {{ $orders->total() }} pesanan</small>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" width="60">No</th>
                            <th>Customer</th>
                            <th>Paket</th>
                            <th class="text-end">Berat (kg)</th>
                            <th class="text-end">Total Harga</th>
                            <th class="text-center">Status Saat Ini</th>
                            <th class="text-center" width="280">Ubah Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="text-center fw-bold">{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 me-3">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $order->user->name }}</strong>
                                            <small class="d-block text-muted">{{ $order->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->package->name }}</td>
                                <td class="text-end">{{ number_format($order->weight, 1) }}</td>
                                <td class="text-end fw-bold text-success">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <span class="badge fs-6 px-3 py-2 status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-flex gap-2 justify-content-center align-items-center">
                                        @csrf

                                        <select name="status" class="form-select form-select-sm w-50">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        </select>

                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-sync-alt"></i> Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-box-open fa-4x text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">Belum ada pesanan</h5>
                                    <p class="text-muted">Pesanan akan muncul di sini setelah customer melakukan pemesanan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="card-footer bg-white border-0">
            <div class="d-flex justify-content-center">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection