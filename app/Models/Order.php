<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_costumer',
        'no_hp',
        'nama_produk',
        'tanggal_pesanan',
        'jenis_pesanan',
        'jumlah',
        'total', 
        'status',
    ];

    public function produk() {
        return $this->belongsTo(Product::class, 'nama_produk', 'nama');
    }

}
