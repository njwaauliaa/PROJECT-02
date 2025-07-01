<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = "detail_pesanan";

    protected $fillable = ['id_pesanan', 'id_produk', 'jumlah', 'subtotal'];
    protected $primaryKey = "id_detail";
}
