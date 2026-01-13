<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@laundry.test',
            'password' => bcrypt('password123'),
            'role'     => 'admin',
            'phone'    => '08123456789',
            'address'  => 'Jl. Admin No. 1'
        ]);

        // Beberapa customer contoh
        User::factory()->count(8)->create([
            'role' => 'customer'
        ]);
    }
}