<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPendapatan extends Model
{
    protected $fillable = [
        'pendapatan_id',
        'menu_id',
        'qty',
        'harga',
        'subtotal'
    ];

    public function pendapatan()
    {
        return $this->belongsTo(Pendapatan::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
