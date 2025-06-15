<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use App\Models\Donasi;
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
            'deskripsi'  => 'required|string|max:1000',
            'keterangan' => 'required|in:Banjir,Gempa,Kebakaran,Tanah Longsor,Lainnya',
            'lokasi'     => 'required|string|max:255',
            'media'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
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

    public function edit($id_laporan)
    {
        $laporan = Laporan::findOrFail($id_laporan);
        return view('pages.laporan.editLaporan', compact('laporan'));
    }

    public function update(Request $request, $id_laporan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'required|in:banjir,gempa,longsor,kebakaran,lainnya',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $laporan = Laporan::findOrFail($id_laporan);

        $laporan->judul = $request->judul;
        $laporan->deskripsi = $request->deskripsi;
        $laporan->lokasi = $request->lokasi;
        $laporan->keterangan = $request->keterangan;

        if ($request->hasFile('foto')) {
            $laporan->foto = $request->file('foto')->store('laporan', 'public');
        }

        $laporan->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy($id_laporan)
    {
        $laporan = Laporan::findOrFail($id_laporan);

        // Misalnya hanya user yang punya laporan bisa hapus
        if (auth()->id() !== $laporan->id_user) {
            return redirect()->route('laporan.index')->with('error', 'Tidak punya akses hapus.');
        }

        // Hapus file foto jika ada
        if ($laporan->foto) {
            Storage::delete('public/' . $laporan->foto);
        }

        // Cek apakah laporan punya donasi
        if ($laporan->donasi()->count() > 0) {
            return redirect()->back()->with('error', 'Laporan ini memiliki donasi aktif. Harap hapus atau selesaikan donasi terlebih dahulu.');
        }
            $laporan->delete();

            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
        }



    public function laporanSaya()
    {
        if (Auth::check()) {
            // Jika login, tampilkan laporan milik user
            $userId = Auth::id();
            $laporan = Laporan::where('id_user', $userId)->latest()->get();
        } else {
            // Jika belum login, tampilkan semua laporan yang sudah diverifikasi (atau sesuaikan logika kamu)
            $laporan = Laporan::where('status', 'verifikasi')->latest()->get();
        }

        return view('pages.laporan.index', compact('laporan'));
    }




}


