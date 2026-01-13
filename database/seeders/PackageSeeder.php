<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            ['name' => 'Cuci Kering + Setrika', 'price' => 8000, 'description' => 'Standar'],
            ['name' => 'Cuci Express (4 jam)',   'price' => 15000, 'description' => 'Cepat'],
            ['name' => 'Cuci Sepatu',            'price' => 35000, 'description' => 'Per pasang'],
            ['name' => 'Dry Cleaning',           'price' => 25000, 'description' => 'Pakaian khusus'],
        ];

        foreach ($packages as $pkg) {
            Package::create($pkg);
        }
    }
}