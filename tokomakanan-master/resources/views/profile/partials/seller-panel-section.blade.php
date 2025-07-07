<section>
    @if(auth()->user()->role === 'pembeli')
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Buka Toko Anda
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Ingin mulai menjual makananmu sendiri? Upgrade akunmu untuk menjadi penjual sekarang juga.
            </p>
        </header>
        <form method="post" action="{{ route('profile.upgrade.seller') }}" class="mt-6">
            @csrf
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">Saya Mau Jadi Penjual!</button>
        </form>
    @else
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Panel Toko Anda
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Akses panel tokomu untuk mengelola produk, melihat pesanan, dan lainnya.
            </p>
        </header>
        <a href="/admin" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
            <i class="fa-solid fa-store mr-2"></i>
            Lihat Toko Saya
        </a>
    @endif
</section>
