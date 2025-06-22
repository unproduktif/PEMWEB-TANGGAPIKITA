<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edukasi;
use App\Models\Laporan;
use App\Models\Donasi;

class HomeController extends Controller
{
    public function index()
    {
        $edukasis = Edukasi::latest()->take(3)->get();
        $laporans = Laporan::where('status', 'verifikasi')->latest()->take(3)->get();
        $donasis = Donasi::latest()->take(3)->get();

        return view('home', compact('edukasis', 'laporans', 'donasis'));
        }
}
