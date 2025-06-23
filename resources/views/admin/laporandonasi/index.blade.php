@extends('components.admin-layout')

@section('content')
{{-- Content Card --}}
<div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all">
    <div class="card-header bg-white py-3 border-0">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="fw-bold mb-0" style="color: #2c3e50;">
                <i class="bi bi-file-earmark-text me-2" style="color: #8DBCC7;"></i>
                Daftar Donasi
            </h3>
        </div>
    </div>

    {{-- Search and Filter Section --}}
<div class="card-body border-bottom">
    <form action="{{ route('admin.laporandonasi.index') }}" method="GET">
        <div class="row g-3">
            {{-- Search Input --}}
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search" style="color: #8DBCC7;"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" name="search" 
                           placeholder="Cari berdasarkan judul donasi..." 
                           value="{{ request('search') }}">
                </div>
            </div>

            {{-- Status Filter --}}
            <div class="col-md-2">
                <select class="form-select" name="status">
                    <option value="">Semua Status</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                </select>
            </div>

            {{-- Report Status Filter --}}
            <div class="col-md-2">
                <select class="form-select" name="status_laporan">
                    <option value="">Semua Laporan</option>
                    <option value="sudah" {{ request('status_laporan') == 'sudah' ? 'selected' : '' }}>Sudah Dilaporkan</option>
                    <option value="belum" {{ request('status_laporan') == 'belum' ? 'selected' : '' }}>Belum Dilaporkan</option>
                </select>
            </div>

            {{-- Time Period Filter --}}
            <div class="col-md-3">
                <select class="form-select" name="waktu">
                    <option value="">Semua Waktu</option>
                    <option value="hari_ini" {{ request('waktu') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="minggu_ini" {{ request('waktu') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="bulan_ini" {{ request('waktu') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="tahun_ini" {{ request('waktu') == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="col-12 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary" style="background-color: #8DBCC7; border-color: #8DBCC7;">
                    <i class="bi bi-funnel-fill me-1"></i> Filter
                </button>
                <a href="{{ route('admin.laporandonasi.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </div>
    </form>
</div>
        <div class="card-body p-0">
            @if($donasis->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-emoji-smile-fill mb-3" style="font-size: 3rem; color: #C4E1E6;"></i>
                    <h5 class="fw-bold mb-2" style="color: #2c3e50;">Belum Ada Donasi Selesai</h5>
                    <p class="text-muted mb-4">Tidak ada campaign donasi yang telah selesai</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #EBFFD8;">
                            <tr>
                                <th class="ps-4" style="width: 60px;">No</th>
                                <th style="min-width: 250px;">Judul Donasi</th>
                                <th style="min-width: 150px;">Total Donasi</th>
                                <th style="width: 120px;">Status</th>
                                <th style="width: 150px;">Laporan</th>
                                <th class="pe-4" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donasis as $i => $donasi)
                                <tr class="border-top">
                                    <td class="ps-4 fw-bold" style="color: #8DBCC7;">{{ ($donasis->currentPage() - 1) * $donasis->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold" style="color: #2c3e50;">{{ $donasi->judul }}</h6>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ \Carbon\Carbon::parse($donasi->tgl_selesai)->translatedFormat('d M Y') }}
                                        </small>
                                    </td>
                                    <td class="fw-bold" style="color: #2c3e50;">
                                        Rp{{ number_format($donasi->total, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill py-2 px-3" style="background-color: #C4E1E6; color: #2c3e50;">
                                            {{$donasi->status}}
                                        </span>
                                    </td>
                                    <td>
                                        @if($donasi->laporanDonasi)
                                            <span class="badge rounded-pill py-2 px-3 d-flex align-items-center" style="background-color: #d4edda; color: #155724;">
                                                <i class="bi bi-check-circle-fill me-1"></i>
                                                Sudah Dilaporkan
                                            </span>
                                        @else
                                            <span class="badge rounded-pill py-2 px-3 d-flex align-items-center" style="background-color: #f8d7da; color: #721c24;">
                                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                                Belum Dilaporkan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="pe-4">
                                        @if(!$donasi->laporanDonasi)
                                            <a href="{{ route('admin.laporandonasi.create', $donasi->id_donasi) }}" 
                                               class="btn btn-sm btn-hover d-flex align-items-center px-3"
                                               style="background-color: #8DBCC7; color: white; border-radius: 8px;">
                                                <i class="bi bi-pencil-square me-1"></i>
                                                Buat Laporan
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-sm btn-hover d-flex align-items-center px-3"
                                               style="background-color: #28a745; color: white; border-radius: 8px;">
                                                <i class="bi bi-eye-fill me-1"></i>
                                                Lihat Laporan
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

        {{-- Pagination --}}
        @if($donasis instanceof \Illuminate\Pagination\AbstractPaginator && $donasis->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mb-0">
                        {{-- Previous Page Link --}}
                        @if($donasis->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link border-0" style="color: #7f8c8d;">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link border-0" href="{{ $donasis->previousPageUrl() }}" style="color: #8DBCC7;">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach(range(1, $donasis->lastPage()) as $page)
                            <li class="page-item {{ $page == $donasis->currentPage() ? 'active' : '' }}">
                                @if($page == $donasis->currentPage())
                                    <span class="page-link rounded-circle mx-1" style="background-color: #8DBCC7; border-color: #8DBCC7;">{{ $page }}</span>
                                @else
                                    <a class="page-link rounded-circle mx-1 border-0" href="{{ $donasis->url($page) }}" style="color: #8DBCC7;">{{ $page }}</a>
                                @endif
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($donasis->hasMorePages())
                            <li class="page-item">
                                <a class="page-link border-0" href="{{ $donasis->nextPageUrl() }}" style="color: #8DBCC7;">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link border-0" style="color: #7f8c8d;">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>

<style>
    .transition-all {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .btn-hover {
        transition: all 0.3s ease;
    }
    
    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(140, 188, 199, 0.1) !important;
    }
    
    @media (max-width: 767.98px) {
        .card:hover {
            transform: none;
        }
    }
</style>

@push('scripts')
<script>
    // Enable tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection