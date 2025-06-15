<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\User_donasi;

class DonasiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $query = Donasi::with('laporan'); // Eager load laporan

        // Pencarian judul
        if ($keyword) {
            $query->where('judul', 'like', "%{$keyword}%");
        }

        $donasi = $query->latest()->get();

        return view('pages.donasi.index', compact('donasi'));
    }

    public function show($id_donasi)
    {
        $donasi = Donasi::with('laporan')->where('id_donasi', $id_donasi)->firstOrFail();
        return view('pages.donasi.detailDonasi', compact('donasi'));
    }

    public function createForm($id_donasi)
    {
        $donasi = Donasi::findOrFail($id_donasi);
        return view('pages.donasi.formDonasi', compact('donasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_donasi' => 'required|exists:donasis,id_donasi',
            'id_user' => 'required|exists:users,id_user',
            'jumlah' => 'required|numeric|min:1000',
        ]);

        User_donasi::create([
            'id_donasi' => $request->id_donasi,
            'id_user' => $request->id_user,
            'jumlah' => $request->jumlah,
            'tanggal' => now(),
        ]);

        return redirect()->route('donasi.index')->with('success', 'Terima kasih atas donasi Anda!');
    }
}
