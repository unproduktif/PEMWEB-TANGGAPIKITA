<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\LaporanDonasi;
use App\Models\AlokasiDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LaporanDonasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Donasi::query()->with('laporanDonasi');
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%");
        }
        if ($request->filled('status_laporan')) {
            if ($request->status_laporan == 'sudah') {
                $query->whereHas('laporanDonasi');
            } elseif ($request->status_laporan == 'belum') {
                $query->whereDoesntHave('laporanDonasi');
            }
        }
        if ($request->filled('waktu')) {
            $now = Carbon::now();
            switch ($request->waktu) {
                case 'hari_ini':
                    $query->whereDate('tgl_selesai', $now->toDateString());
                    break;
                case 'minggu_ini':
                    $query->whereBetween('tgl_selesai', [
                        $now->copy()->startOfWeek(),
                        $now->copy()->endOfWeek()
                    ]);
                    break;
                case 'bulan_ini':
                    $query->whereBetween('tgl_selesai', [
                        $now->copy()->startOfMonth(),
                        $now->copy()->endOfMonth()
                    ]);
                    break;
                case 'tahun_ini':
                    $query->whereBetween('tgl_selesai', [
                        $now->copy()->startOfYear(),
                        $now->copy()->endOfYear()
                    ]);
                    break;
            }
        }

        $donasis = $query->orderBy('tgl_selesai', 'desc')
                        ->paginate(10)
                        ->withQueryString();

        return view('admin.laporandonasi.index', compact('donasis'));
    }

    public function create($id_donasi)
    {
        $donasi = Donasi::findOrFail($id_donasi);
        if ($donasi->status !== 'selesai') {
            return redirect()->route('admin.laporandonasi.index')
                        ->with('error', 'Hanya bisa membuat laporan untuk donasi yang sudah selesai');
        }
        if ($donasi->laporanDonasi) {
            return redirect()->route('admin.laporandonasi.index')
                        ->with('error', 'Laporan untuk donasi ini sudah ada');
        }

        return view('admin.laporandonasi.create', compact('donasi'));
    }

    public function store(Request $request, $id_donasi)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:1000',
            'total' => 'required|numeric|min:0',
            'sisa' => 'required|numeric|min:0|lte:total',
            'tanggal' => 'required|date|before_or_equal:today',
            'alokasi' => 'required|array|min:1',
            'alokasi.*.keterangan' => 'required|string|max:255',
            'alokasi.*.tujuan' => 'required|string|max:255',
            'alokasi.*.jumlah' => 'required|numeric|min:1000',
        ], [
            'sisa.lte' => 'Sisa dana tidak boleh melebihi total dana',
            'alokasi.min' => 'Minimal harus ada 1 alokasi dana',
            'alokasi.*.jumlah.min' => 'Minimal alokasi dana Rp 1.000'
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

        $totalAlokasi = collect($request->alokasi)->sum('jumlah');
        if ($totalAlokasi > $request->total - $request->sisa) {
            return back()->withErrors([
                'alokasi' => 'Total alokasi melebihi dana yang digunakan (Total - Sisa)'
            ])->withInput();

        }

        try {
            $laporan = Laporan_donasi::create([
                'id_donasi' => $id_donasi,
                'id_admin' => Auth::guard('admin')->id(),
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

            return redirect()->route('admin.laporandonasi.index')
                        ->with('success', 'Laporan donasi berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan laporan: ' . $e->getMessage());
        }
    }
}