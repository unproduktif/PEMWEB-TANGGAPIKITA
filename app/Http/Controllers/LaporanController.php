<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return view('pages.laporan.index', compact('laporans'));
    }

    public function indexBencana(Request $request)
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

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('pages.laporan.show', compact('laporan'));
    }

    public function create()
    {
        return view('pages.laporan.formLaporan'); // Sesuai dengan nama view kamu
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'keterangan' => 'required|in:Banjir,Gempa,Kebakaran,Tanah Longsor,Lainnya',
            'lokasi'     => 'required|string|max:255',
            'media'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $laporan = new Laporan();
        $laporan->id_user = auth()->id(); 
        $laporan->id_admin = null;
        $laporan->judul = $request->judul;
        $laporan->deskripsi = $request->deskripsi;
        $laporan->keterangan = $request->keterangan;
        $laporan->lokasi = $request->lokasi;
        $laporan->status = 'pendding';
        $laporan->tgl_publish = null; 

        if ($request->hasFile('media')) {
            $laporan->media = $request->file('media')->store('laporan', 'public');
        }

        $laporan->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim!');
    }

    public function laporanSaya()
    {
        $userId = Auth::id();

        $laporans = Laporan::where('id_user', $userId)->latest()->get();

        return view('pages.laporan.index', compact('laporans'));
    }



}


