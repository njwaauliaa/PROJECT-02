<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil 4 produk terbaru sebagai produk unggulan
        $produksUnggulan = Produk::latest()->take(4)->get();

        return view('landing', ['produksUnggulan' => $produksUnggulan]);
    }
}
