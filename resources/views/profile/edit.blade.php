@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container mx-auto px-4 py-8 lg:px-8">
    <div class="flex flex-col lg:flex-row gap-8">

        <div class="lg:w-1/4">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <nav class="space-y-1">
                    <a href="#info-dasar" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-md">Informasi Profil</a>
                    <a href="#info-alamat" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-md">Alamat & Kontak</a>
                    <a href="#info-password" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-md">Ubah Password</a>
                    <a href="#hapus-akun" class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-md">Hapus Akun</a>
                </nav>
            </div>
             <a href="{{ route('profile.show') }}" class="mt-4 w-full text-center inline-flex items-center justify-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition-colors">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Kembali ke Profil
            </a>
        </div>

        <div class="lg:w-3/4 space-y-6">
            <div id="info-dasar" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div id="info-alamat" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-address-form')
                </div>
            </div>

            <div id="info-password" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div id="hapus-akun" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
