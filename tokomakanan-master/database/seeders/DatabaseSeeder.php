<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Produk::truncate();
        Pesanan::truncate();
        DetailPesanan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $penjualNajwa = User::factory()->penjual()->create([
            'name' => 'Najwa Penjual',
            'email' => 'najwaa6@gmail.com',
        ]);

        $pembeliAnnisa = User::factory()->pembeli()->create([
            'name' => 'Annisa Pembeli',
            'email' => 'annisa@gmail.com',
        ]);

        $pembeliLainnya = User::factory(10)->pembeli()->create();

        $produkNajwa = Produk::factory(8)->create([
            'penjual_id' => $penjualNajwa->id,
        ]);

        for ($i = 0; $i < 5; $i++) {
            $produkBeli = $produkNajwa->random(rand(1, 3));
            $totalHarga = 0;

            $pesanan = Pesanan::factory()->create([
                'penjual_id' => $penjualNajwa->id,
                'pembeli_id' => $pembeliAnnisa->id,
                'total_harga' => 0, 
                'metode_pengiriman' => 'antar',
                'alamat_pengiriman' => $pembeliAnnisa->alamat,
            ]);

            foreach ($produkBeli as $produk) {
                $jumlah = rand(1, 2);
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $produk->id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $produk->harga,
                ]);
                $totalHarga += $produk->harga * $jumlah;
            }

            $pesanan->update(['total_harga' => $totalHarga]);
        }
    }
}