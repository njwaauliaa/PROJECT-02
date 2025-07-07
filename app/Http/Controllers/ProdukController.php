<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->get();
        return view('produk.index', compact('produks'));
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|numeric|min:1'
        ]);
        $produk = Produk::findOrFail($request->produk_id);
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$produk->id])) {
            $keranjang[$produk->id]['jumlah'] += $request->jumlah;
        } else {
            $keranjang[$produk->id] = [
                "nama" => $produk->nama, "jumlah" => $request->jumlah,
                "harga" => $produk->harga, "gambar" => $produk->gambar
            ];
        }
        session()->put('keranjang', $keranjang);

        Alert::success('Berhasil!', 'Produk telah ditambahkan ke keranjang.');
        return back();
    }

}
