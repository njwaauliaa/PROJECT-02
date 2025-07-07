<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'penjual_id',
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
    ];

    public function penjual()
    {
        return $this->belongsTo(User::class, 'penjual_id');
    }

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'produk_id');
    }
}
