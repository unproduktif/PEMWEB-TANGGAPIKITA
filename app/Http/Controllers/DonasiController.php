<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\User_donasi;
use App\Models\Laporan;
use App\Models\Akun;
use App\Models\User;

use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Str;

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

    public function edit($id_donasi)
    {
        $donasi = Donasi::findOrFail($id_donasi);

        if (auth()->user()->id_akun !== $donasi->id_user || $donasi->status !== 'berlangsung') {
            return redirect()->back()->with('error', 'Anda tidak dapat mengedit kampanye ini.');
        }

        return view('pages.donasi.edit', compact('donasi'));
    }

    public function update(Request $request, $id_donasi)
    {
        $donasi = Donasi::findOrFail($id_donasi);

        if (auth()->user()->id_akun !== $donasi->id_user || $donasi->status !== 'berlangsung') {
            return redirect()->back()->with('error', 'Akses tidak diizinkan.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'target' => 'required|numeric|min:10000',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        $donasi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'target' => $request->target,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
        ]);

        return redirect()->route('donasi.kelola')->with('success', 'Donasi berhasil diperbarui.');
    }


    public function selesaikan($id_donasi)
    {
        $donasi = Donasi::findOrFail($id_donasi);

        if (auth()->user()->id_akun !== $donasi->id_user) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $donasi->status = 'selesai';
        $donasi->save();

        return redirect()->back()->with('success', 'Kampanye donasi telah diselesaikan.');
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


    public function createMidtrans(Request $request)
    {
        $request->validate([
            'jumlah'    => 'required|numeric|min:1000',
            'pesan'     => 'nullable|string|max:1000',
        ]);

        $user_donasi = new User_donasi();
        $user_donasi->id_user  = auth()->user()->id_akun;
        $user_donasi->id_donasi = $request->id_donasi;
        $user_donasi->jumlah    = $request->jumlah;
        $user_donasi->metode    = null; // Akan diisi oleh callback Midtrans
        $user_donasi->pesan     = $request->pesan ?? null;
        $user_donasi->status    = 'pending';
        $user_donasi->save();

        do {
            $order_id = 'DONASI-' . strtoupper(Str::random(10));
        } while (User_donasi::where('order_id', $order_id)->exists());

        $user_donasi->order_id = $order_id;
        $user_donasi->save();

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $user_donasi->jumlah,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->nama,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                    'id' => $user_donasi->id_donasi,
                    'price' => $user_donasi->jumlah,
                    'quantity' => 1,
                    'name' => 'Donasi #' . $user_donasi->id_donasi,
                ]
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $user_donasi->snap_token = $snapToken;
        $user_donasi->save();

        return view('pages.donasi.payment', [
            'snapToken' => $snapToken,
            'donasi' => Donasi::find($user_donasi->id_donasi),
            'user_donasi' => $user_donasi
        ]);
    }

    public function redirectToPayment($order_id)
    {
        $userDonasi = User_donasi::where('order_id', $order_id)->firstOrFail();
        $donasi = Donasi::findOrFail($userDonasi->id_donasi);

        // Setup Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        try {
            $status = \Midtrans\Transaction::status($order_id);

            if ($status->transaction_status === 'pending') {
                // Gunakan token lama, JANGAN generate ulang
                $snapToken = $userDonasi->snap_token;

                return view('pages.donasi.payment', [
                    'snapToken' => $snapToken,
                    'donasi' => $donasi,
                    'user_donasi' => $userDonasi,
                ]);
            } else {
                return redirect()->route('donasi.riwayat')->with('error', 'Transaksi sudah tidak bisa dilanjutkan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('donasi.riwayat')->with('error', 'Gagal memeriksa status transaksi: ' . $e->getMessage());
        }
    }

}
