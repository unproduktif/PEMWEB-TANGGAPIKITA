<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index(Request $request){
    $keyword = $request->input('search');
    $donasi = Donasi::when($keyword, function($query, $keyword){
        return $query->where('judul', 'like', "%$keyword%");
    })->get();

    return view('pages.donasi.index', compact('donasi'));
}

    public function show($id_donasi){
    $donasi = Donasi::where('id_donasi', $id_donasi)->firstOrFail();
    return view('pages.donasi.detailDonasi', compact('donasi'));
}
}
