<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanans';

    public $timestamps = false;

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'jumlah',
        'harga_satuan',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function subtotal()
    {
        return $this->jumlah * $this->harga_satuan;
    }
}
