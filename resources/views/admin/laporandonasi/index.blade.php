@extends('components.admin-layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <h3 class="fw-bold text-primary mb-4"><i class="bi bi-file-earmark-text me-2"></i> Laporan Donasi</h3>

        @if($donasis->isEmpty())
            <div class="alert alert-info text-center">Tidak ada donasi yang selesai.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Judul Donasi</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donasis as $i => $donasi)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $donasi->judul }}</td>
                                <td>Rp {{ number_format($donasi->total, 0, ',', '.') }}</td>
                                <td><span class="badge bg-secondary">Selesai</span></td>
                                <td>
                                    @if($donasi->laporanDonasi)
                                        <span class="text-success">Sudah ada</span>
                                    @else
                                        <span class="text-danger">Belum ada</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$donasi->laporanDonasi)
                                        <a href="{{ route('admin.laporandonasi.create', $donasi->id_donasi) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bi bi-pencil-square me-1"></i> Buat Laporan
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
