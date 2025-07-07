@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container mx-auto mt-10 p-4 lg:p-8">
    <div class="flex flex-col lg:flex-row shadow-md my-10">
        <div class="w-full lg:w-3/4 bg-white px-6 lg:px-10 py-10">
            <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Keranjang Belanja Anda</h1>
                <h2 class="font-semibold text-2xl">{{ count($keranjangItems) }} Items</h2>
            </div>

            @if(!empty($keranjangItems))
                <div class="hidden lg:flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Detail Produk</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Jumlah</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Harga</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Subtotal</h3>
                </div>

                @foreach($keranjangItems as $id => $detail)
                <div class="flex items-center hover:bg-gray-100 -mx-2 lg:-mx-8 px-2 lg:px-6 py-5 border-b lg:border-none">
                    <div class="flex w-full lg:w-2/5"> <div class="w-20">
                            <img class="h-24 object-cover"
                            @if ($detail['gambar'])
                                src="{{ asset('storage/' . $detail['gambar']) }}"
                            @else
                                src="{{ url('https://placehold.co/600x400?text=Image not available') }}"
                            @endif
                            alt="{{ $detail['nama'] }}">
                        </div>
                        <div class="flex flex-col justify-between ml-4 flex-grow">
                            <span class="font-bold text-sm">{{ $detail['nama'] }}</span>
                            <form action="{{ route('keranjang.destroy', $id) }}" method="POST" class="mt-2 lg:mt-0">
                                @csrf
                                <button type="submit" class="font-semibold hover:text-red-500 text-gray-500 text-xs">
                                    <i class="fa-solid fa-trash-can mr-1"></i>
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </div>
                    <div class="flex justify-center w-full lg:w-1/5 mt-4 lg:mt-0">
                        <input class="mx-2 border text-center w-16" type="text" value="{{ $detail['jumlah'] }}" readonly disabled>
                    </div>
                    <span class="text-center w-full lg:w-1/5 font-semibold text-sm mt-4 lg:mt-0">Rp {{ number_format($detail['harga']) }}</span>
                    <span class="text-center w-full lg:w-1/5 font-semibold text-sm mt-4 lg:mt-0">Rp {{ number_format($detail['harga'] * $detail['jumlah']) }}</span>
                </div>
                @endforeach

            @else
                <div class="text-center py-20">
                    <i class="fa-solid fa-cart-arrow-down text-6xl text-gray-300"></i>
                    <p class="font-semibold text-xl mt-4">Keranjang Anda masih kosong.</p>
                </div>
            @endif

            <a href="{{ route('home') }}" class="mt-10 inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition-colors">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Lanjut Belanja
            </a>
        </div>

        <div id="summary" class="w-full lg:w-1/qr px-8 py-10 bg-gray-100">
            <h1 class="font-semibold text-2xl border-b pb-8">Ringkasan Pesanan</h1>
            <div class="flex justify-between mt-10 mb-5">
                <span class="font-semibold text-sm uppercase">Total Harga</span>
                <span class="font-semibold text-sm">Rp {{ number_format($total) }}</span>
            </div>
            <a href="{{ route('checkout.index') }}" class="block text-center bg-yellow-500 hover:bg-yellow-600 py-3 text-sm text-white uppercase w-full mt-8 rounded-lg font-semibold">
                Lanjutkan ke Checkout
            </a>
        </div>
    </div>
</div>
@endsection
