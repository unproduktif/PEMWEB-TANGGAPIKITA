@extends('components.admin-layout')

@section('content')
    {{-- Content Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all">
        <div class="card-header bg-white py-3 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold mb-0" style="color: #2c3e50;">
                    <i class="bi bi-clipboard2-data-fill me-2" style="color: #8DBCC7;"></i>
                    Daftar Laporan Bencana
                </h3>
            </div>
        </div>

        {{-- Search and Filter Section --}}
        <div class="card-body border-bottom">
            <form action="{{ route('admin.informasi.index') }}" method="GET">
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

                    {{-- Disaster Type Filter --}}
                    <div class="col-md-3">
                        <select class="form-select" name="jenis_bencana">
                            <option value="">Semua Jenis Bencana</option>
                            @foreach($jenisBencana as $jenis)
                                <option value="{{ $jenis }}" {{ request('jenis_bencana') == $jenis ? 'selected' : '' }}>
                                    {{ ucfirst($jenis) }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Date Filter --}}
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
                        <a href="{{ route('admin.informasi.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            @if($laporans->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-cloud-sun-fill mb-3" style="font-size: 3rem; color: #C4E1E6;"></i>
                    <h5 class="fw-bold mb-2" style="color: #2c3e50;">Tidak Ditemukan Laporan Bencana</h5>
                    <p class="text-muted mb-4">Tidak ada laporan bencana yang sesuai dengan kriteria pencarian</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #EBFFD8;">
                            <tr>
                                <th class="text-center ps-4" style="width: 60px;">No</th>
                                <th style="min-width: 120px;">Judul Laporan</th>
                                <th style="min-width: 120px;">Pelapor</th>
                                <th style="min-width: 120px;">Jenis</th>
                                <th style="min-width: 120px;">Lokasi</th>
                                <th style="min-width: 120px;">Tanggal</th>
                                <th class="text-center pe-4" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporans as $index => $laporan)
                                <tr class="border-top">
                                    <td class="text-center ps-4 fw-bold" style="color: #8DBCC7;">{{ ($laporans->currentPage() - 1) * $laporans->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fw-semibold" style="color: #2c3e50;">{{ $laporan->judul }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="fw-medium">{{ $laporan->user->akun->nama ?? 'Anonim' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill py-2 px-3" style="background-color: #C4E1E6; color: #2c3e50;">
                                            {{ ucfirst($laporan->keterangan) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-geo-alt-fill me-2" style="color: #e74c3c;"></i>
                                            <span>{{ $laporan->lokasi }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>{{ \Carbon\Carbon::parse($laporan->tgl_publish)->translatedFormat('d M Y, H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex align-items-center gap-2">
                                            {{-- Detail Button --}}
                                            <a href="{{ route('admin.informasi.show', $laporan->id_laporan) }}" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #e3f2fd; color: #2c3e50; border-radius: 8px;">
                                                <i class="bi bi-eye-fill me-1"></i> Detail
                                            </a>
                                            {{-- Delete Button --}}
                                            <form action="{{ route('admin.informasi.destroy', $laporan->id_laporan) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #ffebee; color: #c62828; border-radius: 8px;"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
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
                                <a class="page-link border-0" href="{{ $laporans->previousPageUrl() }}" style="color: #8DBCC7;">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach(range(1, $laporans->lastPage()) as $page)
                            <li class="page-item {{ $page == $laporans->currentPage() ? 'active' : '' }}">
                                @if($page == $laporans->currentPage())
                                    <span class="page-link rounded-circle mx-1" style="background-color: #8DBCC7; border-color: #8DBCC7;">{{ $page }}</span>
                                @else
                                    <a class="page-link rounded-circle mx-1 border-0" href="{{ $laporans->url($page) }}" style="color: #8DBCC7;">{{ $page }}</a>
                                @endif
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($laporans->hasMorePages())
                            <li class="page-item">
                                <a class="page-link border-0" href="{{ $laporans->nextPageUrl() }}" style="color: #8DBCC7;">&raquo;</a>
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