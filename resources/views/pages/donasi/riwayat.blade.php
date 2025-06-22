@extends('components.layout')

@section('content')
<div class="container py-5">
    {{-- Header Section --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 mb-3" style="color: #222831;">
            <span class="d-block">Riwayat Transaksi</span>
            <span class="text-gradient" style="background: linear-gradient(to right, #393E46, #00ADB5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Donasi Anda</span>
        </h1>
        <div class="d-flex justify-content-center">
            <div style="width: 100px; height: 4px; background: linear-gradient(to right, #393E46, #00ADB5); border-radius: 2px;"></div>
        </div>
    </div>

    {{-- Content Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color: #EEEEEE;">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0" style="color: #222831;">
                    <i class="bi bi-clock-history me-2" style="color: #00ADB5;"></i> Daftar Donasi
                </h3>
            </div>

            @if($donasiRiwayat->isEmpty())
                <div class="alert alert-info rounded-3 text-center py-4" style="background-color: rgba(0, 173, 181, 0.1); border-left: 4px solid #00ADB5; color: #0c5460;">
                    <i class="bi bi-info-circle-fill me-2" style="color: #00ADB5;"></i>
                    Belum ada riwayat donasi yang tercatat.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle" style="border-color: #393E46;">
                        <thead style="background-color: #222831; color: #EEEEEE;">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 25%;">Nama Donasi</th>
                                <th style="width: 15%;">Jumlah</th>
                                <th style="width: 20%;">Tanggal</th>
                                <th style="width: 15%;">Status</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donasiRiwayat->sortByDesc('pivot.created_at') as $donasi)
                                @php
                                    $status = $donasi->pivot->status ?? 'pending';
                                    $badgeColor = match ($status) {
                                        'pending' => '#FFA41B',
                                        'settlement', 'capture' => '#00ADB5',
                                        'expire' => '#393E46',
                                        'cancel' => '#FF4D4D',
                                        default => '#222831'
                                    };
                                    $textColor = $status === 'pending' ? '#222831' : '#EEEEEE';
                                    $statusText = match ($status) {
                                        'settlement', 'capture' => 'Sukses',
                                        'pending' => 'Pending',
                                        'expire' => 'Kadaluarsa',
                                        'cancel' => 'Dibatalkan',
                                        default => ucfirst($status)
                                    };
                                @endphp
                                <tr style="border-bottom: 1px solid #C4E1E6;">
                                    <td style="color: #393E46;">{{ $loop->iteration }}</td>
                                    <td style="color: #222831; font-weight: 500;">{{ $donasi->judul ?? '-' }}</td>
                                    <td style="color: #00ADB5; font-weight: 600;">
                                        Rp {{ number_format($donasi->pivot->jumlah ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td style="color: #393E46;">
                                        {{ $donasi->pivot->created_at 
                                            ? \Carbon\Carbon::parse($donasi->pivot->created_at)->translatedFormat('d F Y, H:i') 
                                            : '-' }}
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill py-2 px-3 text-uppercase" style="background-color: {{ $badgeColor }}; color: {{ $textColor }};">
                                            {{ $statusText }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($status === 'pending' && !empty($donasi->pivot->order_id))
                                            <a href="{{ route('donasi.payment.redirect', ['order_id' => $donasi->pivot->order_id]) }}" 
                                               class="btn btn-sm btn-hover rounded-pill px-3" 
                                               style="border: 1px solid #00ADB5; color: #00ADB5;">
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
</div>

<style>
    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .btn-hover {
        transition: all 0.3s ease;
    }
    
    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 173, 181, 0.05) !important;
    }
    
    .alert {
        border-left: 4px solid;
    }
</style>
@endsection