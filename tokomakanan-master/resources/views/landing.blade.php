@extends('layouts.app')

@section('title', 'AnakKosFood - Solusi Makanan Praktis & Hemat')

@section('content')
    <section class="relative h-screen bg-cover bg-center text-white flex items-center justify-center -mt-8" style="background-image: url({{ asset('img/landing-page.jpeg') }});">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 text-center px-4">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight">Solusi Makanan Praktis & Hemat</h1>
            <p class="mt-4 text-lg md:text-xl max-w-2xl mx-auto">Pesan makanan favoritmu tanpa ribet, diantar cepat atau ambil sendiri. Dibuat khusus untukmu, anak kos!</p>
            <a href="{{ route('home') }}" class="mt-8 inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300">
                Lihat Menu Sekarang
            </a>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-12">Kenapa Pilih Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="feature-item">
                    <i class="fa-solid fa-hand-holding-dollar text-5xl text-yellow-500 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Harga Terjangkau</h3>
                    <p class="text-gray-600">Menu hemat yang ramah di kantong, tanpa mengorbankan rasa dan kualitas.</p>
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-bolt text-5xl text-yellow-500 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Cepat & Praktis</h3>
                    <p class="text-gray-600">Pesan online dalam hitungan menit. Pilih antar atau ambil sendiri sesuai seleramu.</p>
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-utensils text-5xl text-yellow-500 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Menu Bervariasi</h3>
                    <p class="text-gray-600">Dari makanan berat hingga cemilan, semua ada. Gak bakal bosen!</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Menu Andalan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($produksUnggulan as $produk)
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
                            <span class="font-bold text-lg text-green-600">Rp {{ number_format($produk->harga) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Punya Pertanyaan?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-10">Jangan ragu untuk menghubungi kami melalui salah satu platform di bawah ini. Kami siap membantu!</p>
            <div class="flex justify-center space-x-8">
                <a href="https://wa.me/6288212684681" target="_blank" class="text-gray-500 hover:text-green-500 transition-colors">
                    <i class="fa-brands fa-whatsapp fa-3x"></i>
                    <span class="block mt-2 text-sm">WhatsApp</span>
                </a>
                <a href="https://instagram.com/https://scontent-cgk1-2.cdninstagram.com/v/t51.2885-19/461179972_1686479238806231_6011787635539039979_n.jpg?_nc_ht=scontent-cgk1-2.cdninstagram.com&_nc_cat=111&_nc_oc=Q6cZ2QGBFKUbA_hz-eU_ZDOqXZHpincxBfjt8-EKj4vC9iwzThET7L4DOVRvCWX-ACqvN8w&_nc_ohc=PNS3C2PbpRgQ7kNvwEzlUkn&_nc_gid=PZBlV1HNv6iUqVaBd5nAPA&edm=AP4sbd4BAAAA&ccb=7-5&oh=00_AfSwypz2XR2x2DA0thFBfhmddMWSyXYQKSVX-ehzw7XELA&oe=687113AC&_nc_sid=7a9f4b" target="_blank" class="text-gray-500 hover:text-pink-500 transition-colors">
                    <i class="fa-brands fa-instagram fa-3x"></i>
                    <span class="block mt-2 text-sm">Instagram</span>
                </a>
                <a href="mailto:najwaauliaa6@gmail.com" class="text-gray-500 hover:text-yellow-600 transition-colors">
                    <i class="fa-solid fa-envelope fa-3x"></i>
                    <span class="block mt-2 text-sm">Email</span>
                </a>
            </div>
        </div>
    </section>
@endsection
