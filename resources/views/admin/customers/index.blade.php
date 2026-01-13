@extends('layouts.admin')

@section('title', 'Daftar Customer')

@section('content')
    <h2 class="mb-4">Daftar Customer</h2>

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="60">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor HP</th>
                            <th>Alamat</th>
                            <th class="text-center">Jumlah Order</th>
                            <th class="text-center">Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td class="text-center">{{ $loop->iteration + ($customers->currentPage() - 1) * $customers->perPage() }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone ?? '-' }}</td>
                                <td>{{ Str::limit($customer->address, 40) ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ $customer->orders_count ?? 0 }}</span>
                                </td>
                                <td class="text-center">{{ $customer->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Belum ada customer terdaftar
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection