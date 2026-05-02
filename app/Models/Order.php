<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'kode_pesanan',
        'nama_kasir',
        'nama_pelanggan',
        'total'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
