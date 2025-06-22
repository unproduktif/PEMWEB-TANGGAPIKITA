<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::latest()->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    public function verifikasi($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'verifikasi';
        $laporan->tgl_publish = now();
        $laporan->save();

        return redirect()->back()->with('success', 'Laporan berhasil diverifikasi.');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }
}
