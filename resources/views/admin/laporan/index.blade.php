@extends('components.admin-layout')

@section('content')
<div class="container py-4 py-md-5">
    {{-- Search & Filter --}}
    <div class="search-filter-container mb-4 p-4 rounded-4" style="background-color: #ffebee;">
        <form method="GET" action="{{ route('admin.laporan.index') }}" class="row g-3 align-items-end">
            {{-- Search Input --}}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search" style="color: #e74c3c;"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari laporan..." value="{{ request('search') }}" style="border-color: #dee2e6;">
                    <button type="submit" class="btn px-4" style="background-color: #e74c3c; color: white;">Cari</button>
                </div>
            </div>

            {{-- Filter Dropdown --}}
            <div class="col-md-4">
                <div class="dropdown">
                    <button class="btn w-100 d-flex justify-content-between align-items-center px-3 py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; border: 1px solid #dee2e6; color: #2c3e50;">
                        <span>
                            <i class="bi bi-funnel-fill me-2" style="color: #e74c3c;"></i>
                            Filter Status
                        </span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu p-3 w-100 mt-2 border-0 shadow-lg" style="border-radius: 12px;">
                        <div class="mb-3">
                            <label for="filter_status" class="form-label small fw-bold" style="color: #2c3e50;">Status Laporan</label>
                            <select name="filter_status" id="filter_status" class="form-select border-1" style="border-color: #ffcdd2;">
                                <option value="">Semua Status</option>
                                <option value="verifikasi" {{ request('filter_status') == 'verifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                <option value="pending" {{ request('filter_status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-sm flex-grow-1" style="background-color: #e74c3c; color: white;">Terapkan</button>
                            <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-outline-secondary flex-grow-1">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Reports Table --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden transition-all">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #e74c3c; color: white;">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Pelapor</th>
                            <th>Judul</th>
                            <th>Gambar</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Waktu Lapor</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                        <tr class="transition-all">
                            <td class="ps-4 fw-semibold">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                        <i class="bi bi-person-fill" style="color: #e74c3c;"></i>
                                    </div>
                                    <div>
                                        <span class="d-block">{{ $laporan->user->akun->nama ?? 'Tidak diketahui' }}</span>
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
                            <td>{{ $laporan->lokasi }}</td>
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
                            <td class="text-end pe-4">
                                <div class="d-flex gap-2 justify-content-end">
                                    @if($laporan->status !== 'verifikasi')
                                    <form action="{{ route('admin.laporan.verifikasi', $laporan->id_laporan) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-hover d-flex align-items-center" style="background-color: #e3f2fd; color: #2c3e50; border-radius: 8px;">
                                            <i class="bi bi-check-circle-fill me-1"></i> Verifikasi
                                        </button>
                                    </form>
                                    @endif

                                    <form action="{{ route('admin.laporan.hapus', $laporan->id_laporan) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-hover d-flex align-items-center" style="background-color: #ffebee; color: #c62828; border-radius: 8px;" onclick="return confirm('Hapus laporan ini?')">
                                            <i class="bi bi-trash-fill me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-file-earmark-excel-fill mb-3" style="font-size: 2.5rem; color: #e74c3c;"></i>
                                    <h5 class="fw-bold mb-2" style="color: #2c3e50;">Tidak Ada Laporan</h5>
                                    <p class="text-muted mb-4">Belum ada laporan yang sesuai dengan kriteria pencarian</p>
                                    <a href="{{ route('admin.laporan.index') }}" class="btn px-4" style="background-color: #e74c3c; color: white;">
                                        Reset Filter
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    @if($laporans instanceof \Illuminate\Pagination\AbstractPaginator && $laporans->hasPages())
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
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

<style>
    .search-filter-container {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .transition-all {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    tr:hover {
        background-color: rgba(231, 76, 60, 0.05) !important;
    }
    
    .btn-hover {
        transition: all 0.3s ease;
    }
    
    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .page-item.active .page-link {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }
    
    .page-link {
        color: #e74c3c;
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
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush
@endsection