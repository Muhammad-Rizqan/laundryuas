<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua order
     */
    public function index()
    {
        $orders = Order::with(['user', 'package']) // eager loading relasi
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan form untuk membuat order baru (opsional untuk admin)
     */
    public function create()
    {
        $customers = User::where('role', 'customer')->get(['id', 'name']);
        $packages  = Package::all(['id', 'name', 'price']);

        return view('admin.orders.create', compact('customers', 'packages'));
    }

    /**
     * Menyimpan order baru dari admin
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'package_id'  => 'required|exists:packages,id',
            'weight'      => 'required|numeric|min:0.1',
            'status'      => 'required|in:pending,processing,done,delivered',
        ]);

        $package = Package::findOrFail($request->package_id);
        $total_price = $package->price * $request->weight;

        Order::create([
            'user_id'     => $request->user_id,
            'package_id'  => $request->package_id,
            'weight'      => $request->weight,
            'total_price' => $total_price,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order baru berhasil dibuat');
    }

    /**
     * Menampilkan form edit order
     */
    public function edit(Order $order)
    {
        $order->load(['user', 'package']);
        
        $customers = User::where('role', 'customer')->get(['id', 'name']);
        $packages  = Package::all(['id', 'name', 'price']);

        return view('admin.orders.edit', compact('order', 'customers', 'packages'));
    }

    /**
     * Update data order
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'package_id'  => 'required|exists:packages,id',
            'weight'      => 'required|numeric|min:0.1',
            'status'      => 'required|in:pending,processing,done,delivered',
        ]);

        $package = Package::findOrFail($request->package_id);
        $total_price = $package->price * $request->weight;

        $order->update([
            'user_id'     => $request->user_id,
            'package_id'  => $request->package_id,
            'weight'      => $request->weight,
            'total_price' => $total_price,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Data order berhasil diperbarui');
    }

    /**
     * Menghapus order
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order berhasil dihapus');
    }

    /**
 * Update status order dari admin (AJAX atau form)
 */
public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,processing,done,delivered',
    ]);

    $order->update([
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . ucfirst($request->status));
}
}