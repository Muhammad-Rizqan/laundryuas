<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    // ← INI WAJIB UNTUK Auth::login()
use Illuminate\Support\Facades\Hash;    // Opsional, kalau nanti pakai Hash::make

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),  // ← Lebih aman pakai Hash::make
            'role'     => 'customer',
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);

        Auth::login($user);  // ← Sekarang aman setelah import facade Auth

        return redirect('/dashboard');
    }
}