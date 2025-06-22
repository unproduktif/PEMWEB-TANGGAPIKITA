@extends('components.admin-layout')
@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="dashboard-header mb-4">
    <p class="text-muted">Welcome back, {{ auth()->user()->nama }}. Here's what's happening with your platform.</p>
</div>

<!-- Summary Cards -->
<div class="row g-4 mb-4">
    <!-- Total Reports -->
    <div class="col-md-6 col-lg-3">
        <div class="card summary-card bg-info bg-gradient shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="card-subtitle mb-2">Total Reports</h6>
                        <h3 class="fw-bold mb-0">{{ $totalLaporan }}</h3>
                    </div>
                    <div class="icon-wrapper bg-white-25">
                        <i class="bi bi-clipboard-data-fill"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="d-flex align-items-center">
                        <span class="badge bg-white text-info me-2">Total</span>
                        All time reports collected
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Verified Reports -->
    <div class="col-md-6 col-lg-3">
        <div class="card summary-card bg-success bg-gradient shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="card-subtitle mb-2">Verified</h6>
                        <h3 class="fw-bold mb-0">{{ $laporanTerverifikasi }}</h3>
                    </div>
                    <div class="icon-wrapper bg-white-25">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="d-flex align-items-center">
                        <span class="badge bg-white text-success me-2">{{ $presentaseVerifikasi }}%</span>
                        of total reports verified
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pending Reports -->
    <div class="col-md-6 col-lg-3">
        <div class="card summary-card bg-warning bg-gradient shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="card-subtitle mb-2">Pending Verification</h6>
                        <h3 class="fw-bold mb-0">{{ $laporanBelum }}</h3>
                    </div>
                    <div class="icon-wrapper bg-white-25">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="d-flex align-items-center">
                        <span class="badge bg-white text-warning me-2">Action Needed</span>
                        awaiting your review
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Users -->
    <div class="col-md-6 col-lg-3">
        <div class="card summary-card bg-dark bg-gradient shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="card-subtitle mb-2">Total Users</h6>
                        <h3 class="fw-bold mb-0">{{ $totalUser }}</h3>
                    </div>
                    <div class="icon-wrapper bg-white-25">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="d-flex align-items-center">
                        <span class="badge bg-white text-dark me-2">{{ $totalAdmin }} Admins</span>
                        platform users
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reports and Donations Section -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 h-100">
            <div class="card-header bg-white border-0 pb-0">
                <h5 class="card-title text-info mb-0">
                    <i class="bi bi-pin-map-fill me-2"></i>Recent Reports & Donations
                </h5>
                <p class="text-muted small mb-3">Latest reports with donation progress</p>
            </div>
            <div class="card-body pt-2">
                @forelse ($donasiPerLaporan as $item)
                    @php
                        $persentase = $item->target > 0 ? round(($item->total_donasi / $item->target) * 100, 1) : 0;
                        $progressClass = $persentase >= 100 ? 'bg-success' : 'bg-primary';
                    @endphp

                    <div class="report-item mb-3 p-3 border rounded-3 bg-light-subtle">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1 fw-bold">
                                    <a href="#" class="text-decoration-none text-dark">{{ $item->judul }}</a>
                                </h6>
                                <small class="text-muted">Report ID: {{ $item->id_laporan }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success fs-6">
                                    Rp{{ number_format($item->total_donasi, 0, ',', '.') }}
                                </span>
                                <div class="small text-muted">of Rp{{ number_format($item->target, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="progress-wrapper">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>Progress</span>
                                <span>{{ $persentase }}%</span>
                            </div>
                            <div class="progress rounded-pill" style="height: 8px;">
                                <div class="progress-bar {{ $progressClass }}" role="progressbar" 
                                     style="width: {{ $persentase }}%;" 
                                     aria-valuenow="{{ $persentase }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="bi bi-inbox fs-1 text-muted"></i>
                        <p class="text-muted mt-2">No donation records available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-3 h-100">
            <div class="card-header bg-white border-0">
                <h5 class="card-title text-primary mb-0">
                    <i class="bi bi-graph-up-arrow me-2"></i>Monthly Reports
                </h5>
                <p class="text-muted small mb-3">Report trends by month</p>
            </div>
            <div class="card-body pt-0" style="height: 300px;">
                <canvas id="laporanChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Additional Metrics -->
<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title text-success mb-1">
                            <i class="bi bi-cash-coin me-2"></i>Total Donations
                        </h5>
                        <p class="text-muted small">All time collected donations</p>
                    </div>
                    <h2 class="fw-bold text-success">Rp{{ number_format($totalDonasi, 0, ',', '.') }}</h2>
                </div>
                <div class="mt-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle-fill text-success me-2"></i>
                        <small class="text-muted">Includes all verified donations</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-0">
                <h5 class="card-title text-info mb-0">
                    <i class="bi bi-person-gear me-2"></i>User Roles
                </h5>
                <p class="text-muted small mb-3">Platform user distribution</p>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-6">
                        <div class="metric-box text-center p-3 bg-primary bg-opacity-10 rounded-3">
                            <h3 class="fw-bold text-primary mb-1">{{ $totalAdmin }}</h3>
                            <small class="text-muted">Administrators</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="metric-box text-center p-3 bg-info bg-opacity-10 rounded-3">
                            <h3 class="fw-bold text-info mb-1">{{ $totalUser - $totalAdmin }}</h3>
                            <small class="text-muted">Regular Users</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Monthly Reports Chart
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
                label: 'Reports',
                data: [
                    @for ($i = 1; $i <= 12; $i++)
                        {{ $laporanPerBulan[$i] ?? 0 }},
                    @endfor
                ],
                backgroundColor: 'rgba(13, 110, 253, 0.7)',
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#2c3e50',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(0,0,0,0.1)',
                    borderWidth: 1,
                    padding: 10,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: { 
                        stepSize: 10,
                        color: '#6c757d'
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6c757d'
                    }
                }
            }
        }
    });
</script>

<style>
    .dashboard-header {
        border-bottom: 1px solid rgba(0,0,0,0.1);
        padding-bottom: 1rem;
    }
    
    .summary-card {
        border: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        color: white;
    }
    
    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .icon-wrapper {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .bg-white-25 {
        background-color: rgba(255,255,255,0.25);
    }
    
    .report-item {
        transition: all 0.3s ease;
    }
    
    .report-item:hover {
        background-color: #f8f9fa !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .metric-box {
        transition: all 0.3s ease;
    }
    
    .metric-box:hover {
        background-color: rgba(13, 110, 253, 0.15) !important;
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }
        
        .report-item {
            padding: 1rem;
        }
    }
</style>
@endsection