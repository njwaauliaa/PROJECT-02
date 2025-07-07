<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PesananController extends Controller
{
    public function index()
    {
        $keranjangItems = session()->get('keranjang', []);

        if (empty($keranjangItems)) {
            Alert::warning('Keranjang Kosong', 'Silakan tambahkan produk ke keranjang terlebih dahulu.');
            return redirect()->route('keranjang.index');
        }

        $total = 0;
        foreach ($keranjangItems as $detail) {
            $total += $detail['harga'] * $detail['jumlah'];
        }

        return view('pesanan.index', [
            'keranjangItems' => $keranjangItems,
            'total' => $total
        ]);
    }

    public function show(Pesanan $pesanan)
    {
        if (Auth::id() !== $pesanan->pembeli_id) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki akses ke pesanan ini.');
            return redirect()->route('pesanan.riwayat');
        }

        return view('pesanan.show', ['pesanan' => $pesanan]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'metode_pengiriman' => 'required|in:antar,ambil',
            'metode_pembayaran' => 'required|in:transfer,tunai',
            'alamat_pengiriman' => 'required_if:metode_pengiriman,antar|nullable|string',
        ]);

        $keranjang = session()->get('keranjang', []);
        if (empty($keranjang)) {
            Alert::warning('Keranjang Kosong', 'Silakan tambahkan produk ke keranjang terlebih dahulu.');
            return redirect()->route('keranjang.index');
        }

        DB::transaction(function () use ($request, $keranjang) {
            $totalHarga = 0;
            $penjual_id = null;

            foreach ($keranjang as $id => $detail) {
                $produk = Produk::find($id);
                if ($penjual_id === null) {
                    $penjual_id = $produk->penjual_id;
                }
                $totalHarga += $detail['harga'] * $detail['jumlah'];
            }

            $pesanan = Pesanan::create([
                'pembeli_id' => Auth::id(),
                'penjual_id' => $penjual_id,
                'total_harga' => $totalHarga,
                'metode_pengiriman' => $request->metode_pengiriman,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => 'menunggu_konfirmasi',
                'alamat_pengiriman' => $request->alamat_pengiriman,
            ]);

            foreach ($keranjang as $id => $detail) {
                $produk = Produk::find($id);
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $id,
                    'jumlah' => $detail['jumlah'],
                    'harga_satuan' => $detail['harga'],
                ]);

                $produk->decrement('stok', $detail['jumlah']);
            }
        });

        session()->forget('keranjang');

        Alert::success('Pesanan Berhasil', 'Terima kasih telah berbelanja!');
        return redirect()->route('home');
    }

    public function uploadBukti(Request $request, Pesanan $pesanan)
    {
        if (Auth::id() !== $pesanan->pembeli_id) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki akses untuk mengupload bukti pembayaran pada pesanan ini.');
            return redirect()->route('pesanan.riwayat');
        }

        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $path = $request->file('bukti_transfer')->store('bukti-transfer', 'public');

        $pesanan->update([
            'bukti_transfer' => $path,
            'status' => 'menunggu_konfirmasi_pembayaran',
            'waktu_pembayaran' => now(),
        ]);

        Alert::success('Berhasil!', 'Bukti pembayaran telah diupload. Mohon tunggu konfirmasi dari penjual.');

        return back();
    }

    public function riwayat()
    {
        $pesanans = Pesanan::where('pembeli_id', Auth::id())
                            ->latest()
                            ->get();

        return view('pesanan.riwayat', ['pesanans' => $pesanans]);
    }

    public function konfirmasiTerima(Pesanan $pesanan)
    {
        if (Auth::id() !== $pesanan->pembeli_id) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki akses untuk mengonfirmasi penerimaan pesanan ini.');
            return redirect()->route('pesanan.riwayat');
        }

        $pesanan->update([
            'konfirmasi_diterima' => true,
        ]);

        Alert::success('Terima Kasih!', 'Terima kasih telah mengonfirmasi pesanan Anda.');

        return back();
    }
}
