@extends('layouts.app')

@section('title', $produk->nama)

@section('content')
<div class="container mx-auto p-8">

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <a href="{{ route('home') }}" class="mb-6 inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition-colors">
        <i class="fa-solid fa-arrow-left mr-2"></i>
        Kembali ke Katalog
    </a>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex">
        <div class="lg:w-1/2">
            <img
            @if ($produk->gambar)
                src="{{ asset('storage/' . $produk->gambar) }}"
            @else
                src="{{ url('https://placehold.co/600x400?text=Image not available') }}"
            @endif
            class="w-full h-full object-cover max-h-[500px]">
        </div>
        <div class="p-8 lg:w-1/2 flex flex-col justify-center">
            <h1 class="text-4xl font-bold mb-2">{{ $produk->nama }}</h1>
            <p class="text-gray-600 mb-6">Dijual oleh: <span class="font-semibold text-yellow-700">{{ $produk->penjual->name }}</span></p>

            <p class="text-gray-700 text-base mb-6">
                {{ $produk->deskripsi }}
            </p>

            <div class="mb-6">
                <span class="font-bold text-3xl text-green-600">Rp {{ number_format($produk->harga) }}</span>
                <span class="text-gray-500 ml-4">Stok: {{ $produk->stok }}</span>
            </div>

            <form action="{{ route('produk.store') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <div class="flex items-center space-x-4">
                    <div class="w-1/3">
                         <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                         <input type="number" name="jumlah" id="jumlah" value="1" min="1" max="{{ $produk->stok }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                    </div>
                    <div class="w-2/3 pt-6">
                         <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-cart-plus"></i>
                            <span>Tambah ke Keranjang</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
