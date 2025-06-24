@extends('components.admin-layout')

@section('content')
<div class="container py-4 py-md-5">
    {{-- Content Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all">
        <div class="card-header bg-white py-3 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold mb-0" style="color: #2c3e50;">
                    <i class="bi bi-clipboard2-pulse-fill me-2" style="color: #8DBCC7;"></i>
                    Kelola Laporan Masyarakat
                </h3>
            </div>
        </div>

        {{-- Search and Filter Section --}}
        <div class="card-body border-bottom">
            <form action="{{ route('admin.laporan.index') }}" method="GET">
                <div class="row g-3">
                    {{-- Search Input --}}
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search" style="color: #8DBCC7;"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" name="search" 
                                   placeholder="Cari berdasarkan judul atau lokasi..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>

                    {{-- Status Filter --}}
                    <div class="col-md-3">
                        <select class="form-select" name="filter_status">
                            <option value="">Semua Status</option>
                            <option value="verifikasi" {{ request('filter_status') == 'verifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="pending" {{ request('filter_status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        </select>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="col-md-3 d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary" style="background-color: #8DBCC7; border-color: #8DBCC7;">
                            <i class="bi bi-funnel-fill me-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 m-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body p-0">
            @if($laporans->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-file-earmark-excel-fill mb-3" style="font-size: 3rem; color: #8DBCC7;"></i>
                    <h5 class="fw-bold mb-2" style="color: #2c3e50;">Tidak Ada Laporan</h5>
                    <p class="text-muted mb-4">Belum ada laporan yang sesuai dengan kriteria pencarian</p>
                    <a href="{{ route('admin.laporan.index') }}" class="btn px-4" style="background-color: #8DBCC7; color: white;">
                        Reset Filter
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #ffebee;">
                            <tr>
                                <th class="text-center ps-4" style="width: 60px;">No</th>
                                <th>Pelapor</th>
                                <th>Judul</th>
                                <th>Gambar</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Waktu Lapor</th>
                                <th class="text-center pe-4" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporans as $laporan)
                            <tr class="border-top">
                                <td class="text-center ps-4 fw-bold" style="color: #8DBCC7;">{{ ($laporans->currentPage() - 1) * $laporans->perPage() + $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                            <i class="bi bi-person-fill" style="color: #8DBCC7;"></i>
                                        </div>
                                        <div>
                                            <span class="d-block fw-medium">{{ $laporan->user->akun->nama ?? 'Tidak diketahui' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-semibold">{{ $laporan->judul }}</td>
                                <td>
                                    @if($laporan->media)
                                        <img src="{{ asset('storage/' . $laporan->media) }}" alt="Gambar Laporan" width="80" class="rounded-3 shadow-sm object-fit-cover" style="height: 60px;">
                                    @else
                                        <span class="badge bg-light text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-geo-alt-fill me-2" style="color: #8DBCC7;"></i>
                                        <span>{{ $laporan->lokasi }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill py-2 px-3 bg-{{ $laporan->status === 'verifikasi' ? 'success' : 'warning' }}-subtle text-{{ $laporan->status === 'verifikasi' ? 'success' : 'warning' }}">
                                        <i class="bi bi-{{ $laporan->status === 'verifikasi' ? 'check-circle' : 'clock' }} me-1"></i>
                                        {{ ucfirst($laporan->status) }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d M Y, H:i') }}
                                    </small>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($laporan->status !== 'verifikasi')
                                        <form action="{{ route('admin.laporan.verifikasi', $laporan->id_laporan) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" 
                                                    style="background-color: #e3f2fd; color: #2c3e50; border-radius: 8px;"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="bi bi-check-circle-fill me-1"></i> Verifikasi
                                            </button>
                                        </form>
                                        @endif

                                        <form action="{{ route('admin.laporan.hapus', $laporan->id_laporan) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" 
                                                    style="background-color: #ffebee; color: #c62828; border-radius: 8px;"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                <i class="bi bi-trash-fill me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Pagination --}}
        @if($laporans instanceof \Illuminate\Pagination\AbstractPaginator && $laporans->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mb-0">
                        {{-- Previous Page Link --}}
                        @if($laporans->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link border-0" style="color: #7f8c8d;">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link border-0" href="{{ $laporans->previousPageUrl() }}" style="color: #e74c3c;">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach(range(1, $laporans->lastPage()) as $page)
                            <li class="page-item {{ $page == $laporans->currentPage() ? 'active' : '' }}">
                                @if($page == $laporans->currentPage())
                                    <span class="page-link rounded-circle mx-1" style="background-color: #e74c3c; border-color: #e74c3c;">{{ $page }}</span>
                                @else
                                    <a class="page-link rounded-circle mx-1 border-0" href="{{ $laporans->url($page) }}" style="color: #e74c3c;">{{ $page }}</a>
                                @endif
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($laporans->hasMorePages())
                            <li class="page-item">
                                <a class="page-link border-0" href="{{ $laporans->nextPageUrl() }}" style="color: #e74c3c;">&raquo;</a>
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
        background-color: rgba(231, 76, 60, 0.05) !important;
    }
    
    .object-fit-cover {
        object-fit: cover;
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