@extends('layouts.admin')

@section('title', 'Daftar Paket')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Paket Laundry</h2>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Paket
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Harga (Rp)</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($packages as $package)
                        <tr>
                            <td>{{ $loop->iteration + ($packages->currentPage() - 1) * $packages->perPage() }}</td>
                            <td>{{ $package->name }}</td>
                            <td>{{ number_format($package->price, 0, ',', '.') }}</td>
                            <td>{{ $package->description ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus paket ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Belum ada paket laundry</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $packages->links() }}
            </div>
        </div>
    </div>
@endsection