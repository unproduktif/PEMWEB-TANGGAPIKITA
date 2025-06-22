<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\Laporan_donasi;
use App\Models\Alokasi_dana;
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

        $laporan = Laporan_donasi::create([
            'id_donasi' => $id_donasi,
            'id_admin' => Auth::guard('admin')->id(), // pastikan guard admin
            'deskripsi' => $request->deskripsi,
            'total' => $request->total,
            'sisa' => $request->sisa,
            'tanggal' => $request->tanggal,
        ]);

        foreach ($request->alokasi as $item) {
            Alokasi_dana::create([
                'id_laporandonasi' => $laporan->id_laporandonasi,
                'keterangan' => $item['keterangan'],
                'tujuan' => $item['tujuan'],
                'jumlah' => $item['jumlah'],
            ]);
        }

        return redirect()->route('admin.laporandonasi.index')->with('success', 'Laporan donasi berhasil disimpan.');
    }
}
