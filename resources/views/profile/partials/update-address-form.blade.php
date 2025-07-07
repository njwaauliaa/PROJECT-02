<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informasi Alamat
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Perbarui alamat pengiriman default.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update.address') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
            <textarea id="alamat" name="alamat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 h-24">{{ old('alamat', $user->alamat) }}</textarea>
        </div>


        <div class="flex items-center gap-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md text-sm">Simpan</button>

            @if (session('status') === 'address-updated')
                <p class="text-sm text-gray-600">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>
