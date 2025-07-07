@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-8">Checkout Pesanan</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Bagian Kiri: Form Pengisian Data --}}
            <div class="w-full lg:w-2/3">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Detail Pengiriman</h2>

                    <div class="mb-4">
                        <label for="nama_pembeli" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_pembeli" id="nama_pembeli" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <div x-data="{ deliveryMethod: 'antar' }">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Metode Pengiriman</label>
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="metode_pengiriman" value="antar" x-model="deliveryMethod">
                                    <span class="ml-2">Antar ke Alamat</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" name="metode_pengiriman" value="ambil" x-model="deliveryMethod">
                                    <span class="ml-2">Ambil di Lokasi</span>
                                </label>
                            </div>
                        </div>

                        <div id="alamat-form" class="mb-4" x-show="deliveryMethod === 'antar'" x-transition>
                            <label for="alamat_pengiriman" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                            <textarea name="alamat_pengiriman" id="alamat_pengiriman" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ auth()->user()->alamat }}</textarea>
                        </div>
                    </div>

                     <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                         <div class="mt-2 space-y-2">
                             <label class="inline-flex items-center">
                                 <input type="radio" name="metode_pembayaran" value="transfer" checked>
                                 <span class="ml-2">Transfer</span>
                             </label>
                             <label class="inline-flex items-center ml-6">
                                 <input type="radio" name="metode_pembayaran" value="tunai">
                                 <span class="ml-2">Tunai</span>
                             </label>
                         </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Kanan: Ringkasan Pesanan --}}
            <div class="w-full lg:w-1/3">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 border-b pb-4">Ringkasan Pesanan</h2>
                    @foreach($keranjangItems as $item)
                        <div class="flex justify-between items-center mb-2">
                            <span>{{ $item['nama'] }} (x{{ $item['jumlah'] }})</span>
                            <span>Rp {{ number_format($item['harga'] * $item['jumlah']) }}</span>
                        </div>
                    @endforeach
                    <div class="flex justify-between items-center mt-4 pt-4 border-t">
                        <span class="font-bold text-lg">Total</span>
                        <span class="font-bold text-lg">Rp {{ number_format($total) }}</span>
                    </div>
                    <button type="submit" class="w-full mt-6 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded-lg">
                        Buat Pesanan Sekarang
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
