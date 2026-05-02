<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    protected $fillable = [
        'kode_pesanan',
        'nama_kasir',
        'nama_pelanggan',
        'item',
        'total',
        'cash',
        'kembalian',
        'status'
    ];

    public function details()
    {
        return $this->hasMany(DetailPendapatan::class);
    }
}