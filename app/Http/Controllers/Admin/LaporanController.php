<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::with('user.akun'); // biar gak N+1, opsional

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                ->orWhere('lokasi', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }

        // Pagination
        $laporans = $query->orderBy('created_at', 'desc')->paginate(10);

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
