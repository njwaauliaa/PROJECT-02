<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjual_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pembeli_id')->constrained('users')->onDelete('cascade');
            $table->decimal('total_harga');
            $table->enum('metode_pengiriman', ['antar', 'ambil']);
            $table->enum('metode_pembayaran', ['transfer', 'tunai']);
            $table->enum('status', ['menunggu_konfirmasi', 'menunggu_pembayaran', 'menunggu_konfirmasi_pembayaran', 'pembayaran_ditolak', 'diproses', 'selesai', 'dibatalkan'])->default('menunggu_konfirmasi');
            $table->string('bukti_transfer')->nullable();
            $table->timestamp('waktu_pembayaran')->nullable();
            $table->boolean('konfirmasi_diterima')->default(false);
            $table->timestamp('waktu_konfirmasi')->nullable();
            $table->string('catatan')->nullable();
            $table->string('alamat_pengiriman')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
