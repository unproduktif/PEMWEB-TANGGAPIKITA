<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\LaporanDonasi;
use App\Models\AlokasiDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanDonasiController extends Controller
{
    public function index()
    {
        $donasis = Donasi::where('status', 'selesai')->with('laporanDonasi')->get();
        return view('admin.laporandonasi.index', compact('donasis'));
    }

    public function create($id_donasi)
    {
        $donasi = Donasi::findOrFail($id_donasi);
        return view('admin.laporandonasi.create', compact('donasi'));
    }

    public function store(Request $request, $id_donasi)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'total' => 'required|numeric',
            'sisa' => 'required|numeric',
            'tanggal' => 'required|date',
            'alokasi.*.keterangan' => 'required|string',
            'alokasi.*.tujuan' => 'required|string',
            'alokasi.*.jumlah' => 'required|numeric',
        ]);

        $laporan = LaporanDonasi::create([
            'id_donasi' => $id_donasi,
            'id_admin' => Auth::user()->id_akun, // pastikan guard admin
            'deskripsi' => $request->deskripsi,
            'total' => $request->total,
            'sisa' => $request->sisa,
            'tanggal' => $request->tanggal,
        ]);

        foreach ($request->alokasi as $item) {
            AlokasiDana::create([
                'id_laporandonasi' => $laporan->id_laporandonasi,
                'keterangan' => $item['keterangan'],
                'tujuan' => $item['tujuan'],
                'jumlah' => $item['jumlah'],
            ]);
        }

        return redirect()->route('admin.laporandonasi.index')->with('success', 'Laporan donasi berhasil disimpan.');
    }
}
