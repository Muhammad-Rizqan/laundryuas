<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin
     */
    public function index()
    {
        // Hitung statistik yang akan ditampilkan di dashboard
        $totalOrders = Order::count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $totalCustomers = User::where('role', 'customer')->count();

        $totalPackages = Package::count();

        // Kirim data ke view
        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'totalCustomers',
            'totalPackages'
        ));
    }
}