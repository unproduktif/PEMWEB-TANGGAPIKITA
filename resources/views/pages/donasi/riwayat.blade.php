@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-clock-history me-2"></i> Riwayat Donasi
        </h3>

        {{-- Cek jika riwayat kosong --}}
        @if($donasiRiwayat->isEmpty())
            <div class="alert alert-info">
                Belum ada riwayat donasi yang tercatat.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Donasi</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donasiRiwayat as $index => $donasi)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $donasi->nama_donasi ?? '-' }}</td>
                                <td>Rp {{ number_format($donasi->pivot->jumlah ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    {{ $donasi->pivot->created_at ? \Carbon\Carbon::parse($donasi->pivot->created_at)->translatedFormat('d F Y') : '-' }}
                                </td>
                                <td>
                                    <span class="badge bg-success">Sukses</span>
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
