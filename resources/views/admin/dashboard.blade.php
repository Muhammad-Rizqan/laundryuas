@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="h3 mb-4">Dashboard</h1>

    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-3 col-sm-6">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Order</h5>
                    <h2>{{ $totalOrders ?? '0' }}</h2>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-3 col-sm-6">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title">Pesanan Pending</h5>
                    <h2>{{ $pendingOrders ?? '0' }}</h2>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-3 col-sm-6">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Customer</h5>
                    <h2>{{ $totalCustomers ?? '0' }}</h2>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-3 col-sm-6">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Paket</h5>
                    <h2>{{ $totalPackages ?? '0' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Recent Orders (bisa ditambah nanti) -->
@endsection