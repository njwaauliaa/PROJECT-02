@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container mx-auto px-4 py-8 lg:px-8">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Kolom Kiri: Foto & Nama --}}
        <div class="lg:w-1/3">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <img class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-yellow-400" src="{{ $user->avatar_url }}" alt="Avatar {{ $user->name }}">
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500 capitalize">{{ $user->role }}</p>
                <a href="{{ route('profile.edit') }}" class="mt-6 w-full inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md text-sm transition duration-300">
                    Edit Profil
                </a>
            </div>
        </div>

        {{-- Kolom Kanan: Detail Informasi --}}
        <div class="lg:w-2/3">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700 border-b pb-4">Informasi Akun</h3>
                <dl class="mt-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="md:col-span-2 text-sm text-gray-900">{{ $user->email }}</dd>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                        <dd class="md:col-span-2 text-sm text-gray-900 whitespace-pre-wrap">{{ $user->alamat ?? 'Belum diatur' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                @include('profile.partials.seller-panel-section')
            </div>
        </div>

    </div>
</div>
@endsection
