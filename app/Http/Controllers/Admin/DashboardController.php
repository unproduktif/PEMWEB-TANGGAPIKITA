<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\LaporanDonasi;
use App\Models\Edukasi;
use App\Models\Donasi;
use App\Models\User;
use App\Models\Akun;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLaporan = Laporan::count();
        $laporanTerverifikasi = Laporan::where('status', 'verifikasi')->count();
        $laporanBelum = $totalLaporan - $laporanTerverifikasi;
        $presentaseVerifikasi = $totalLaporan > 0 ? round(($laporanTerverifikasi / $totalLaporan) * 100, 1) : 0;
        $totalAdmin = Akun::where('role', 'admin')->count();


        $totalUser = User::count();
        $totalDonasi = DB::table('user_donasis')->sum('jumlah');

        $donasiPerLaporan = DB::table('laporans')
            ->leftJoin('donasis', 'laporans.id_laporan', '=', 'donasis.id_laporan')
            ->leftJoin('user_donasis', 'donasis.id_donasi', '=', 'user_donasis.id_donasi')
            ->select(
                'laporans.id_laporan',
                'laporans.judul',
                DB::raw('COALESCE(donasis.target, 0) as target'),
                DB::raw('COALESCE(SUM(user_donasis.jumlah), 0) as total_donasi')
            )
            ->groupBy('laporans.id_laporan', 'laporans.judul', 'donasis.target')
            ->orderByDesc('total_donasi')
            ->get();


        $laporanPerBulan = Laporan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        return view('admin.dashboard', compact(
            'totalDonasi',
            'donasiPerLaporan',
            'totalLaporan',
            'laporanTerverifikasi',
            'laporanBelum',
            'presentaseVerifikasi',
            'totalUser',
            'totalDonasi',
            'laporanPerBulan',
            'totalAdmin'

        ));
    }
}
