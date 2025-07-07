<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
        </p>
    </header>

    {{-- Tombol Pemicu Modal --}}
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md text-sm"
    >Hapus Akun</button>

    {{-- Modal Konfirmasi Penghapusan --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Password</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                    placeholder="Password"
                />

                {{-- Menampilkan error jika password salah --}}
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                {{-- Tombol Batal --}}
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-md">
                    Batal
                </button>

                {{-- Tombol Konfirmasi Hapus --}}
                <button type="submit" class="ml-3 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md text-sm">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
