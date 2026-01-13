<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'weight',
        'total_price',
        'status',
    ];

    /**
     * Relasi: Order dimiliki oleh satu User (Customer)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Order menggunakan satu Package
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}