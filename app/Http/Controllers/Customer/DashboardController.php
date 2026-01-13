<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $orders = Order::where('user_id', $user->id)
            ->with('package')           // penting agar $order->package->name bisa dipakai
            ->latest()                  // urut dari yang terbaru
            ->paginate(10);             // ← ini yang memperbaiki error

        // Hitung statistik (bisa pakai query terpisah, lebih efisien daripada count ulang collection)
        $totalOrders     = Order::where('user_id', $user->id)->count();
        $pendingOrders   = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $completedOrders = Order::where('user_id', $user->id)
            ->whereIn('status', ['done', 'delivered'])
            ->count();

        return view('customer.dashboard', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'completedOrders'
        ));
    }
}