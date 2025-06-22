@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-clock-history me-2"></i> Riwayat Donasi
        </h3>

        @if($donasiRiwayat->isEmpty())
            <div class="alert alert-info">
                Belum ada riwayat donasi yang tercatat.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Donasi</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donasiRiwayat->sortByDesc('pivot.created_at') as $donasi)
                            @php
                                $status = $donasi->pivot->status ?? 'pending';
                                $badgeClass = match ($status) {
                                    'pending' => 'warning',
                                    'settlement', 'capture' => 'success',
                                    'expire' => 'secondary',
                                    'cancel' => 'danger',
                                    default => 'info'
                                };
                                $statusText = match ($status) {
                                    'settlement', 'capture' => 'Sukses',
                                    'pending' => 'Pending',
                                    'expire' => 'Kadaluarsa',
                                    'cancel' => 'Dibatalkan',
                                    default => ucfirst($status)
                                };
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $donasi->judul ?? '-' }}</td>
                                <td><strong>Rp {{ number_format($donasi->pivot->jumlah ?? 0, 0, ',', '.') }}</strong></td>
                                <td>
                                    {{ $donasi->pivot->created_at 
                                        ? \Carbon\Carbon::parse($donasi->pivot->created_at)->translatedFormat('d F Y, H:i') 
                                        : '-' }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $badgeClass }} text-uppercase">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td>
                                    @if ($status === 'pending' && !empty($donasi->pivot->order_id))
                                        <a href="{{ route('donasi.payment.redirect', ['order_id' => $donasi->pivot->order_id]) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-cash-coin me-1"></i> Lanjutkan Pembayaran
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
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
