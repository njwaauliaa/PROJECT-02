@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $pesanan->id)

@section('content')
<div class="container mx-auto p-8">
    <a href="{{ route('pesanan.riwayat') }}" class="mb-6 inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition-colors">
        <i class="fa-solid fa-arrow-left mr-2"></i>
        Kembali ke Riwayat Pesanan
    </a>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col lg:flex-row justify-between border-b pb-4 mb-4">
            <div>
                <h1 class="text-2xl font-bold">Detail Pesanan #{{ $pesanan->id }}</h1>
                <p class="text-sm text-gray-500">Dipesan pada: {{ $pesanan->created_at->format('d F Y, H:i') }}</p>
            </div>
            <div class="mt-4 lg:mt-0">
                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                    @if($pesanan->status == 'selesai')
                    @elseif($pesanan->status == 'dibatalkan') bg-red-100
                    @else text-yellow-800 @endif
                    {{ str_replace('_', ' ', $pesanan->status) }}
                </span>
            </div>
        </div>

        <h2 class="text-lg font-semibold mb-2">Item yang Dipesan:</h2>
        <div class="divide-y divide-gray-200 mb-6">
            @foreach($pesanan->details as $detail)
            <div class="flex items-center py-4">
                <img
                @if ($detail->produk->gambar)
                    src="{{ asset('storage/' . $detail->produk->gambar) }}"
                @else
                    src="{{ url('https://placehold.co/600x400?text=Image not available') }}"
                @endif
                alt="{{ $detail->produk->nama }}" class="w-16 h-16 object-cover rounded mr-4">
                <div class="flex-grow">
                    <p class="font-semibold">{{ $detail->produk->nama }}</p>
                    <p class="text-sm text-gray-600">{{ $detail->jumlah }} x Rp {{ number_format($detail->harga_satuan) }}</p>
                </div>
                <p class="font-semibold">Rp {{ number_format($detail->jumlah * $detail->harga_satuan) }}</p>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-2">Detail Pengiriman</h3>
                <p class="text-gray-700">Metode: <span class="font-medium">{{ ucfirst($pesanan->metode_pengiriman) }}</span></p>
                @if($pesanan->metode_pengiriman == 'antar')
                    <p class="text-gray-700">Alamat: <span class="font-medium">{{ $pesanan->alamat_pengiriman }}</span></p>
                @endif
            </div>
            <div class="text-left md:text-right">
                <h3 class="text-lg font-semibold mb-2">Total Pembayaran</h3>
                <p class="text-2xl font-bold text-green-600">Rp {{ number_format($pesanan->total_harga) }}</p>
                <p class="text-sm text-gray-600">via {{ ucfirst($pesanan->metode_pembayaran) }}</p>
            </div>
        </div>

        @if($pesanan->status == 'selesai' && !$pesanan->konfirmasi_diterima)
            <div class="mt-8 border-t pt-6 text-center">
                <p class="text-gray-600 mb-4">Apakah Anda sudah menerima pesanan ini dengan baik?</p>
                <form action="{{ route('pesanan.konfirmasi_terima', $pesanan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-md">
                        Ya, Pesanan Sudah Diterima
                    </button>
                </form>
            </div>
        @endif

        @if($pesanan->metode_pembayaran == 'transfer' && $pesanan->status == 'menunggu_pembayaran')
            <div class="mt-8 border-t pt-6">
                <h3 class="text-lg font-semibold mb-2">Konfirmasi Pembayaran</h3>
                <p class="text-sm text-gray-600 mb-4">Silakan transfer ke rekening XXX dan upload bukti pembayaran di sini (Maks. 2MB).</p>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pesanan.upload_bukti', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <label for="bukti_transfer" class="cursor-pointer bg-white border border-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-md hover:bg-gray-50">
                            <i class="fa-solid fa-file-image mr-2"></i>
                            Pilih File
                        </label>
                        <input type="file" name="bukti_transfer" id="bukti_transfer" class="hidden" required>

                        <span id="file-chosen" class="text-sm text-gray-500">Tidak ada file dipilih</span>
                    </div>
                    <button type="submit" class="mt-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md">Upload Bukti</button>
                </form>
            </div>

            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const fileChosen = document.getElementById('file-chosen');
    fileInput.addEventListener('change', function(){
        fileChosen.textContent = this.files[0].name
    })
</script>
@endpush
