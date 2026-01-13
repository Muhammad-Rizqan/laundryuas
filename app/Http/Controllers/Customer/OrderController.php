<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
  {
      $packages = \App\Models\Package::all();
      return view('customer.order.create', compact('packages'));
  }

  public function store(Request $request)
  {
      $request->validate([
          'package_id' => 'required|exists:packages,id',
          'weight' => 'required|numeric|min:0.1',
      ]);

      $package = \App\Models\Package::find($request->package_id);
      $total_price = $package->price * $request->weight;

      \App\Models\Order::create([
          'user_id' => auth()->id(),
          'package_id' => $request->package_id,
          'weight' => $request->weight,
          'total_price' => $total_price,
          'status' => 'pending',
      ]);

      return redirect()->route('customer.dashboard')
          ->with('success', 'Pesanan berhasil dibuat! Menunggu konfirmasi admin.');
  }
}
