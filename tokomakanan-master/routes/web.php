<?php

use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');

Route::middleware('auth')->group(function () {
    Route::get('/katalog', [ProdukController::class, 'index'])->name('home');
    Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');

    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    Route::get('/checkout', [PesananController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [PesananController::class, 'store'])->name('checkout.store');

    Route::get('/pesanan-saya', [PesananController::class, 'riwayat'])->name('pesanan.riwayat');
    Route::get('/pesanan-saya/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan-saya/{pesanan}/upload-bukti', [PesananController::class, 'uploadBukti'])->name('pesanan.upload_bukti');
    Route::post('/pesanan-saya/{pesanan}/konfirmasi-terima', [PesananController::class, 'konfirmasiTerima'])->name('pesanan.konfirmasi_terima');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/address', [ProfileController::class, 'updateAddress'])->name('profile.update.address');
    Route::post('/profile/upgrade-seller', [ProfileController::class, 'upgradeToSeller'])->name('profile.upgrade.seller');
});

require __DIR__.'/auth.php';
