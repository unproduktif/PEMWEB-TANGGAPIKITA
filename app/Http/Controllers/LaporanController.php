<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

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

}
