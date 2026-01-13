@extends('layouts.admin')

@section('title', 'Tambah Paket Baru')

@section('content')
    <h2 class="mb-4">Tambah Paket Laundry Baru</h2>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.packages.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Paket</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga per Kg (Rp)</label>
                    <input type="number" name="price" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi (opsional)</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Paket</button>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection