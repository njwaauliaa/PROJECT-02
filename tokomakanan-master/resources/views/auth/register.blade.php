@extends('layouts.app')

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="container mx-auto">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8 mt-10">
        <h1 class="text-2xl font-bold text-center mb-6">Buat Akun Baru</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                <input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="mt-4">
                <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
                <textarea id="alamat" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" name="alamat" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                <input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" type="password" name="password" required>
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password</label>
                <input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" type="password" name="password_confirmation" required>
            </div>

            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    Sudah punya akun?
                </a>
                <button type="submit" class="ml-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
