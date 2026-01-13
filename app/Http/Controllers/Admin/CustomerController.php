<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar semua customer
     */
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->withCount('orders') // menghitung jumlah order per customer
            ->latest()
            ->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Menampilkan form tambah customer baru (opsional)
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Menyimpan customer baru dari admin
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'customer',
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer baru berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit customer
     */
    public function edit(User $customer)
    {
        // Pastikan hanya customer yang bisa diedit di sini
        if ($customer->role !== 'customer') {
            abort(403);
        }

        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update data customer
     */
    public function update(Request $request, User $customer)
    {
        if ($customer->role !== 'customer') {
            abort(403);
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $customer->id,
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Data customer berhasil diperbarui');
    }

    /**
     * Menghapus customer
     */
    public function destroy(User $customer)
    {
        if ($customer->role !== 'customer') {
            abort(403);
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer berhasil dihapus');
    }
}