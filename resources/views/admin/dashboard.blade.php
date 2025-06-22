@extends('components.admin-layout')
@php use Illuminate\Support\Str; @endphp

@section('content')
<h2 class="mt-5 mb-4 fw-bold text-primary">
    <i class="bi bi-bar-chart-line-fill me-2"></i>Dashboard Admin
</h2>

<div class="row g-4 mb-4">
    <!-- Total Laporan -->
    <div class="col-md-3">
        <div class="card text-white bg-info shadow-sm h-100 border-0 rounded-4">
            <div class="card-body d-flex flex-column align-items-start">
                <div class="mb-2 fs-2"><i class="bi bi-clipboard-data-fill"></i></div>
                <h6 class="card-title">Total Laporan</h6>
                <h4 class="fw-bold">{{ $totalLaporan }}</h4>
            </div>
        </div>
    </div>
    <!-- Laporan Terverifikasi -->
    <div class="col-md-3">
        <div class="card text-white bg-success shadow-sm h-100 border-0 rounded-4">
            <div class="card-body d-flex flex-column align-items-start">
                <div class="mb-2 fs-2"><i class="bi bi-check-circle-fill"></i></div>
                <h6 class="card-title">Terverifikasi</h6>
                <h4 class="fw-bold">{{ $laporanTerverifikasi }} <small class="text-white-50">({{ $presentaseVerifikasi }}%)</small></h4>
            </div>
        </div>
    </div>
    <!-- Laporan Belum Terverifikasi -->
    <div class="col-md-3">
        <div class="card text-white bg-warning shadow-sm h-100 border-0 rounded-4">
            <div class="card-body d-flex flex-column align-items-start">
                <div class="mb-2 fs-2"><i class="bi bi-hourglass-split"></i></div>
                <h6 class="card-title">Belum Verifikasi</h6>
                <h4 class="fw-bold">{{ $laporanBelum }}</h4>
            </div>
        </div>
    </div>
    <!-- Total User -->
    <div class="col-md-3">
        <div class="card text-white bg-dark shadow-sm h-100 border-0 rounded-4">
            <div class="card-body d-flex flex-column align-items-start">
                <div class="mb-2 fs-2"><i class="bi bi-people-fill"></i></div>
                <h6 class="card-title">Total User</h6>
                <h4 class="fw-bold">{{ $totalUser }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- Tambahan: Data Role User -->
<div class="row g-4 mb-4">
    <!-- Admin -->
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm h-100 border-0 rounded-4">
            <div class="card-body d-flex flex-column align-items-start">
                <div class="mb-2 fs-2"><i class="bi bi-person-gear"></i></div>
                <h6 class="card-title">Jumlah Admin</h6>
                <h4 class="fw-bold">{{ $totalAdmin }}</h4>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
        <h5 class="card-title text-info mb-4">
            <i class="bi bi-pin-map-fill me-2"></i>Daftar Laporan & Donasi Terkait
        </h5>

        @forelse ($donasiPerLaporan as $item)
            @php
                $persentase = $item->target > 0 ? round(($item->total_donasi / $item->target) * 100, 1) : 0;
            @endphp

            <div class="mb-4 p-3 border rounded-4 bg-light-subtle shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <h6 class="mb-1 text-primary fw-bold">{{ $item->judul }}</h6>
                        <small class="text-muted">ID Laporan: {{ $item->id_laporan }}</small>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success fs-6">
                            Rp{{ number_format($item->total_donasi, 0, ',', '.') }}
                        </span>
                        <div class="small text-muted">dari target Rp{{ number_format($item->target, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="progress rounded-pill" style="height: 10px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $persentase }}%;" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted d-block mt-1">Tercapai {{ $persentase }}%</small>
            </div>
        @empty
            <p class="text-muted">
                <i class="bi bi-inbox me-1"></i>Belum ada donasi yang masuk ke laporan mana pun.
            </p>
        @endforelse
    </div>
</div>
    
<!-- Grafik dan Donasi -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <h5 class="card-title text-success mb-3">
                    <i class="bi bi-cash-coin me-2"></i>Donasi Terkumpul
                </h5>
                <h3 class="fw-bold text-success">Rp{{ number_format($totalDonasi, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <h5 class="card-title text-primary mb-3">
                    <i class="bi bi-graph-up-arrow me-2"></i>Grafik Laporan per Bulan
                </h5>
                <canvas id="laporanChart" height="180"></canvas>
            </div>
        </div>
    </div>
</div>


@endsection



@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('laporanChart').getContext('2d');
    const laporanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @for ($i = 1; $i <= 12; $i++)
                    '{{ \Carbon\Carbon::create()->month($i)->format('M') }}',
                @endfor
            ],
            datasets: [{
                label: 'Jumlah Laporan',
                data: [
                    @for ($i = 1; $i <= 12; $i++)
                        {{ $laporanPerBulan[$i] ?? 0 }},
                    @endfor
                ],
                backgroundColor: 'rgba(13, 110, 253, 0.7)',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#222',
                    titleColor: '#fff',
                    bodyColor: '#fff'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endsection
