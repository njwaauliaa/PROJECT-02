@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container mx-auto">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8 mt-10">
        <h1 class="text-2xl font-bold text-center mb-6">Login ke Akun Anda</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                <input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" type="password" name="password" required>
            </div>
            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
