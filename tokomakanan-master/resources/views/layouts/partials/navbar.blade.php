<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-6 py-3 flex justify-between items-center">
        <a class="text-2xl font-bold text-yellow-600" href="{{ route('landing-page') }}">AnakKosFood</a>
        <div class="flex items-center space-x-6">
            @guest
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-yellow-600">Login</a>
                <a href="{{ route('register') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md text-sm transition duration-300">
                    Daftar
                </a>
            @else
                <a class="text-gray-600 hover:text-yellow-600" href="{{ route('home') }}">Katalog</a>
                <a href="{{ route('pesanan.riwayat') }}" class="text-gray-600 hover:text-yellow-600">Riwayat Pesanan</a> {{-- <-- TAMBAHKAN INI --}}
                <a href="{{ route('keranjang.index') }}" class="relative text-gray-600 hover:text-yellow-600">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="absolute -top-2 -right-2 bg-yellow-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        {{ count(session('keranjang', [])) }}
                    </span>
                </a>
                <div x-data="{ isOpen: false }" class="relative">
                    <button @click="isOpen = !isOpen" class="flex items-center space-x-2 text-gray-800 font-medium focus:outline-none">
                        <span>Hi, {{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div
                        x-show="isOpen"
                        @click.outside="isOpen = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                        style="display: none;"
                    >
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>

                        <div class="border-t border-gray-100"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Logout
                            </a>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>
