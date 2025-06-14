<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Laporan;
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

    // public function createForm($id_donasi)
    // {
    //     $donasi = Donasi::findOrFail($id_donasi);
    //     return view('pages.donasi.formDonasi', compact('donasi'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id_donasi' => 'required|exists:donasis,id_donasi',
    //         'id_user' => 'required|exists:users,id_user',
    //         'jumlah' => 'required|numeric|min:1000',
    //     ]);

    //     User_donasi::create([
    //         'id_donasi' => $request->id_donasi,
    //         'id_user' => $request->id_user,
    //         'jumlah' => $request->jumlah,
    //         'tanggal' => now(),
    //     ]);

    //     return redirect()->route('donasi.index')->with('success', 'Terima kasih atas donasi Anda!');
    // }

    public function createCampaign($id_laporan)
    {
        $laporan = Laporan::findOrFail($id_laporan);

        // Validasi user adalah pemilik
        if (auth()->user()->id_akun !== $laporan->id_user || $laporan->status !== 'verifikasi') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membuat kampanye donasi.');
        }

        return view('pages.donasi.form', compact('laporan'));
    }

    public function storeCampaign(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_laporan' => 'required|exists:laporans,id_laporan',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'target' => 'required|numeric|min:10000',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        Donasi::create($validated);

        return redirect()->route('donasi.index')->with('success', 'Kampanye donasi berhasil dibuat!');
    }
}
