@extends('layouts.admin')

@section('title', 'Edit Paket - ' . $package->name)

@section('content')
    <h2 class="mb-4">Edit Paket: {{ $package->name }}</h2>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.packages.update', $package) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Isi form sama seperti create, hanya value diisi $package -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Paket <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $package->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Harga per Kg (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="price" step="100" min="0" class="form-control @error('price') is-invalid @enderror" 
                           value="{{ old('price', $package->price) }}" required>
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $package->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i>Update Paket
                    </button>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary px-4">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection