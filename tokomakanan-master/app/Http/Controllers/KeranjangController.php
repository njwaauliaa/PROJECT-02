<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjangItems = session()->get('keranjang', []);

        $total = 0;
        foreach($keranjangItems as $detail) {
            $total += $detail['harga'] * $detail['jumlah'];
        }

        return view('keranjang.index', [
            'keranjangItems' => $keranjangItems,
            'total' => $total
        ]);
    }

    public function destroy($id)
    {
        $keranjang = session()->get('keranjang');

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
            Alert::success('Berhasil!', 'Produk telah dihapus dari keranjang.');
        } else {
            Alert::error('Gagal!', 'Produk tidak ditemukan di keranjang.');
        }

        return back();
    }
}
