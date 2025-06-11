<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query()->where('status', 'verifikasi');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%$search%")
                ->orWhere('keterangan', 'like', "%$search%")
                ->orWhere('deskripsi', 'like', "%$search%")
                ->orWhere('lokasi', 'like', "%$search%");
            });
        }

        // Filter waktu
        $now = now();
        if ($request->filled('filter_waktu')) {
            switch ($request->filter_waktu) {
                case 'hari':
                    $query->whereDate('tgl_publish', $now->toDateString());
                    break;
                case 'minggu':
                    $query->whereBetween('tgl_publish', [$now->startOfWeek(), $now->endOfWeek()]);
                    break;
                case 'bulan':
                    $query->whereMonth('tgl_publish', $now->month)
                        ->whereYear('tgl_publish', $now->year);
                    break;
                case 'tanggal':
                    if ($request->filled('tanggal')) {
                        $query->whereDate('tgl_publish', $request->tanggal);
                    }
                    break;
            }
        }

        $laporans = $query->latest()->get();

        return view('pages.bencana', compact('laporans'));
    }

    public function show(Laporan $laporan)
    {
        return view('laporans.show', compact('laporan'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'keterangan' => 'nullable|string',
            'lokasi' => 'required|string|max:255',
            'media' => 'required|file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240',
            'tgl_publish' => 'nullable|date', // ✅ ini perbaikannya
            'id_user' => 'required|integer',
            'id_admin' => 'required|integer',
        ]);

        // Tentukan nilai default jika kosong
        $tglPublish = $request->tgl_publish ?? now();

        // Proses upload media
        $mediaPath = $request->file('media')->store('uploads/media', 'public');

        // Simpan ke database
        Laporan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'keterangan' => $request->keterangan,
            'lokasi' => $request->lokasi,
            'media' => $mediaPath,
            'tgl_publish' => $tglPublish, // ✅ pakai nilai yang sudah diproses
            'id_user' => $request->id_user,
            'id_admin' => $request->id_admin,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
    }



}


