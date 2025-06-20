<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Laporan;
use App\Models\User_donasi;

class DonasiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $query = Donasi::with('laporan'); // Eager load laporan

        // Pencarian judul
        if ($keyword) {
            $query->where('judul', 'like', "%{$keyword}%");
        }

        $donasi = $query->latest()->get();

        return view('pages.donasi.index', compact('donasi'));
    }

    public function show($id_donasi)
    {
        $donasi = Donasi::with('laporan')->where('id_donasi', $id_donasi)->firstOrFail();
        return view('pages.donasi.detailDonasi', compact('donasi'));
    }

    public function createForm($id_donasi)
    {
        $donasi = Donasi::findOrFail($id_donasi);
        return view('pages.donasi.formDonasi', compact('donasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_donasi' => 'required|exists:donasis,id_donasi',
            'metode' => 'required|in:transfer,qris,e-wallet,lainnya',
            'jumlah' => 'required|numeric|min:1000',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pesan' => 'nullable|string|max:1000',
        ]);

        $user_donasi = new User_donasi();
        $user_donasi->id_user = auth()->user()->id_akun;
        $user_donasi->id_donasi = $request->id_donasi;
        $user_donasi->jumlah = $request->jumlah;
        $user_donasi->metode = $request->metode;
        $user_donasi->pesan = $request->pesaan;

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bukti'), $filename);
            $user_donasi->bukti_pembayaran = 'uploads/bukti/' . $filename;
        }

        $user_donasi->save();
        Donasi::where('id_donasi', $request->id_donasi)->increment('total', $request->jumlah);

        return redirect()->route('donasi.index')->with('success', 'Terima kasih atas donasi Anda!');
    }

    public function createCampaign($id_laporan)
    {
        $laporan = Laporan::findOrFail($id_laporan);

        // Validasi user adalah pemilik
        if (auth()->user()->id_akun !== $laporan->id_user || $laporan->status !== 'verifikasi') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membuat kampanye donasi.');
        }

        return view('pages.donasi.form', compact('laporan'));
    }

    public function storeCampaign(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'target'      => 'required|numeric|min:10000',
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'id_laporan'  => 'required|exists:laporans,id_laporan',
        ]);

        $donasi = new Donasi();
        $donasi->id_user     = auth()->user()->id_akun;
        $donasi->id_laporan  = $request->id_laporan;
        $donasi->judul       = $request->judul;
        $donasi->deskripsi   = $request->deskripsi;
        $donasi->target      = $request->target;
        $donasi->total       = 0;
        $donasi->tgl_mulai   = $request->tgl_mulai;
        $donasi->tgl_selesai = $request->tgl_selesai;
        $donasi->save();

        return redirect()->route('donasi.index')->with('success', 'Kampanye donasi berhasil dibuat!');
    }

    public function riwayat()
    {
        $user = Auth::user();
        $donasiRiwayat = $user->user->donasis; // relasi belongsToMany
        return view('pages.donasi.riwayat', compact('donasiRiwayat'));
    }

    public function kelola()
    {
        $user = Auth::user();
        $donasiKelola = $user->user->donasi; // relasi hasMany
        return view('pages.donasi.kelola', compact('donasiKelola'));
    }

}
