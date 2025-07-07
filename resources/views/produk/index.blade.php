@extends('layouts.app')

@section('title', 'Katalog Makanan')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-4xl font-bold mb-8 text-center">Menu Makanan Anak Kos</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse ($produks as $produk)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:-translate-y-2">
                <a href="{{ route('produk.show', $produk->id) }}">
                    <img
                    @if ($produk->gambar)
                        src="{{ asset('storage/' . $produk->gambar) }}"
                    @else
                        src="{{ url('https://placehold.co/600x400?text=Image not available') }}"
                    @endif
                    alt="{{ $produk->nama }}" class="w-full h-48 object-cover">
                </a>
                <div class="p-4">
                    <h2 class="font-bold text-xl mb-2 truncate">{{ $produk->nama }}</h2>
                    <p class="text-gray-600 text-sm h-10 overflow-hidden">{{ Str::limit($produk->deskripsi, 50) }}</p>
                    <div class="flex items-center justify-between mt-4">
                        <span class="font-bold text-lg text-green-600">Rp {{ number_format($produk->harga) }}</span>
                        <a href="{{ route('produk.show', $produk->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full text-sm transition duration-300">
                            Pesan
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center col-span-full">Belum ada produk yang tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
