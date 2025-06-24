<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class InformasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query()->with('user.akun');
        $query->where('status', 'verifikasi');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }
        if ($request->filled('jenis_bencana')) {
            $query->where('keterangan', $request->jenis_bencana);
        }
        if ($request->filled('waktu')) {
            $now = Carbon::now();
            switch ($request->waktu) {
                case 'hari_ini':
                    $query->whereDate('tgl_publish', $now->toDateString());
                    break;
                case 'minggu_ini':
                    $query->whereBetween('tgl_publish', [$now->startOfWeek(), $now->endOfWeek()]);
                    break;
                case 'bulan_ini':
                    $query->whereMonth('tgl_publish', $now->month)
                          ->whereYear('tgl_publish', $now->year);
                    break;
                case 'tahun_ini':
                    $query->whereYear('tgl_publish', $now->year);
                    break;
            }
        }
        $laporans = $query->orderBy('tgl_publish', 'desc')->paginate(10);
        $jenisBencana = ['Banjir', 'Gempa', 'Kebakaran', 'Tanah Longsor', 'Lainnya'];
        return view('admin.informasi.index', compact('laporans', 'jenisBencana'));
    }
    public function show($id)
    {
        $laporan = Laporan::with('user.akun')->findOrFail($id);
        return view('admin.informasi.show', compact('laporan'));
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        if ($laporan->media && Storage::exists('public/' . $laporan->media)) {
            Storage::delete('public/' . $laporan->media);
        }
        if ($laporan->donasi()->count() > 0) {
            return redirect()->back()->with('error', 'Informasi terhubung ke donasi aktif.');
        }
        $laporan->delete();
        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }
}
