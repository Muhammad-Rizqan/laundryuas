@extends('customer.layout')

@section('title', 'Pesan Laundry Baru')

@section('content')
    <div class="container mt-5">
        <h2>Pesan Laundry Baru</h2>

        <form method="POST" action="{{ route('customer.order.store') }}">
            @csrf
            <!-- Isi form seperti versi lengkap sebelumnya -->
            <div class="mb-3">
                <label>Pilih Paket</label>
                <select name="package_id" class="form-control" required>
                    @foreach ($packages as $p)
                        <option value="{{ $p->id }}">{{ $p->name }} - Rp {{ number_format($p->price) }}/kg</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Berat (kg)</label>
                <input type="number" name="weight" step="0.1" min="0.1" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Kirim Pesanan</button>
        </form>
    </div>
@endsection