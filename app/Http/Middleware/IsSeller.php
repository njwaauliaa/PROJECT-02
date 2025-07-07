<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class IsSeller
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'penjual') {
            return $next($request);
        }

        Alert::error('Akses ditolak', 'Hanya penjual yang dapat mengakses halaman ini.')->persistent('Tutup');
        return redirect()->route('home');
    }
}
