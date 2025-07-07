<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $guarded = ['id'];

    public function pembeli()
    {
        return $this->belongsTo(User::class, 'pembeli_id', 'id');
    }

    public function penjual()
    {
        return $this->belongsTo(User::class, 'penjual_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }
}
