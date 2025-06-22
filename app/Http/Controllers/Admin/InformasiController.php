<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    // Tampilkan semua laporan yang sudah diverifikasi
    public function index()
    {
        $laporans = Laporan::where('status', 'verifikasi')->latest()->get();
        return view('admin.informasi.index', compact('laporans'));
    }

    public function show($id)
    {
        $laporan = Laporan::with(['user.akun'])->findOrFail($id);
        return view('admin.informasi.show', compact('laporan'));
    }


    // Hapus informasi
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        if ($laporan->media && Storage::exists('public/' . $laporan->media)) {
            Storage::delete('public/' . $laporan->media);
        }
        $laporan->delete();

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }
}
