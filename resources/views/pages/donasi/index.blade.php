@extends('components.layout')

@section('content')
<div class="container py-4 py-md-5">

    {{-- Hero Section --}}
    <div class="text-center mb-5 px-3">
        <h1 class="fw-bold display-5 display-md-4 mb-3" style="color: #2c3e50;">
            <span class="d-block">Kebaikan Tidak Pernah Terlambat,</span>
            <span class="text-gradient" style="background: linear-gradient(to right, #8DBCC7, #00ADB5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Mulailah Hari Ini</span>
        </h1>
        <p class="lead text-muted mb-4">
            <span class="fw-medium" style="color: #2c3e50;">TanggapiKita</span> — Jembatan Kecil Antara Niat Baikmu dan Harapan Mereka.
        </p>
        <div class="d-flex justify-content-center">
            <div style="width: 100px; height: 4px; background: linear-gradient(to right, #8DBCC7, #00ADB5); border-radius: 2px;"></div>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="search-filter-container mb-4 p-4 rounded-4" style="background-color: #EBFFD8;">
        <form method="GET" action="{{ route('donasi.index') }}" class="row g-3 align-items-end">
            {{-- Search Input --}}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search" style="color: #8DBCC7;"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari kampanye donasi..." value="{{ request('search') }}" style="border-color: #dee2e6;">
                    <button type="submit" class="btn px-4" style="background-color: #8DBCC7; color: white;">Cari</button>
                </div>
            </div>

            {{-- Filter Dropdown --}}
            <div class="col-md-4">
                <div class="dropdown">
                    <button class="btn w-100 d-flex justify-content-between align-items-center px-3 py-2" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false"
                        style="background-color: white; border: 1px solid #dee2e6; color: #2c3e50;">
                        <span>
                            <i class="bi bi-funnel-fill me-2" style="color: #8DBCC7;"></i>
                            Filter Laporan
                        </span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu p-3 w-100 mt-2 border-0 shadow-lg" style="border-radius: 12px;">
                        {{-- Filter Waktu --}}
                        <div class="mb-3">
                            <label for="filter_waktu" class="form-label small fw-bold" style="color: #2c3e50;">Waktu Kejadian</label>
                            <select name="filter_waktu" id="filter_waktu" class="form-select border-1"
                                style="border-color: #C4E1E6;" onchange="toggleTanggalInput()">
                                <option value="">Semua Waktu</option>
                                <option value="hari" {{ request('filter_waktu') == 'hari' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="minggu" {{ request('filter_waktu') == 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="bulan" {{ request('filter_waktu') == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
                                <option value="tanggal" {{ request('filter_waktu') == 'tanggal' ? 'selected' : '' }}>Pilih Tanggal</option>
                            </select>
                        </div>

                        {{-- Filter Tanggal --}}
                        <div class="mb-3" id="tanggal-wrapper" style="display: none;">
                            <label for="tanggal" class="form-label small fw-bold" style="color: #2c3e50;">Tanggal Spesifik</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control border-1"
                                style="border-color: #C4E1E6;" value="{{ request('tanggal') }}">
                        </div>

                        {{-- Filter Jenis Bencana --}}
                        <div class="mb-3">
                            <label for="filter_keterangan" class="form-label small fw-bold" style="color: #2c3e50;">Jenis Bencana</label>
                            <select name="filter_keterangan" id="filter_keterangan" class="form-select border-1"
                                style="border-color: #C4E1E6;">
                                <option value="">Semua Jenis</option>
                                <option value="Banjir" {{ request('filter_keterangan') == 'Banjir' ? 'selected' : '' }}>Banjir</option>
                                <option value="Gempa" {{ request('filter_keterangan') == 'Gempa' ? 'selected' : '' }}>Gempa</option>
                                <option value="Kebakaran" {{ request('filter_keterangan') == 'Kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                <option value="Tanah Longsor" {{ request('filter_keterangan') == 'Tanah Longsor' ? 'selected' : '' }}>Tanah Longsor</option>
                                <option value="Lainnya" {{ request('filter_keterangan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-sm flex-grow-1" style="background-color: #8DBCC7; color: white;">
                                Terapkan
                            </button>
                            <a href="{{ route('donasi.index') }}" class="btn btn-sm btn-outline-secondary flex-grow-1">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            function toggleTanggalInput() {
                const filter = document.getElementById('filter_waktu').value;
                const tanggalWrapper = document.getElementById('tanggal-wrapper');
                tanggalWrapper.style.display = (filter === 'tanggal') ? 'block' : 'none';
            }

            document.addEventListener("DOMContentLoaded", toggleTanggalInput);
        </script>
    </div>

    {{-- Donation Campaigns --}}
    <div class="row g-4">
        @forelse ($donasi as $item)
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-all">
                <div class="row g-0 h-100">
                    {{-- Campaign Image --}}
                    <div class="col-md-4 position-relative">
                        @if($item->laporan && $item->laporan->media)
                            <img src="{{ asset('storage/' . $item->laporan->media) }}" class="img-fluid h-100 w-100 object-fit-cover" style="min-height: 220px;" alt="{{ $item->judul }}">
                        @else
                            <div class="h-100 w-100 d-flex align-items-center justify-content-center" style="background-color: #C4E1E6; min-height: 220px;">
                                <i class="bi bi-heart-fill text-white" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <div class="position-absolute bottom-0 start-0 w-100 px-3 py-2" style="background-color: rgba(0,0,0,0.5);">
                            <small class="text-white">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ \Carbon\Carbon::parse($item->tgl_mulai)->translatedFormat('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($item->tgl_selesai)->translatedFormat('d M Y') }}
                            </small>
                        </div>
                    </div>

                    {{-- Campaign Content --}}
                    <div class="col-md-8">
                        <div class="card-body h-100 d-flex flex-column p-4">
                            <div class="flex-grow-1">
                                <h3 class="card-title fw-bold mb-3" style="color: #2c3e50;">{{ $item->judul }}</h3>
                                <p class="text-muted mb-4" style="line-height: 1.6;">{{ Str::limit($item->deskripsi, 200) }}</p>
                                
                                {{-- Progress Bar --}}
                                @php
                                    $persentase = ($item->target > 0) ? ($item->total / $item->target) * 100 : 0;
                                @endphp
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <small class="fw-semibold" style="color: #2c3e50;">Rp{{ number_format($item->total, 0, ',', '.') }} terkumpul</small>
                                        <small class="text-muted">Rp{{ number_format($item->target, 0, ',', '.') }} target</small>
                                    </div>
                                    <div class="progress" style="height: 10px; background-color: #EBFFD8;">
                                        <div class="progress-bar progress-bar-animated" role="progressbar" 
                                             style="background-color: #00ADB5; width: {{ $persentase }}%;" 
                                             aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="text-end mt-1">
                                        <small class="fw-semibold" style="color: #8DBCC7;">{{ number_format($persentase, 0) }}%</small>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Action Buttons --}}
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('donasi.show', $item->id_donasi) }}" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center flex-grow-1" 
                                style="background-color: #A4CCD9; color: #2c3e50; border-radius: 8px;">
                                    <i class="bi bi-eye-fill me-1"></i> Detail Kampanye
                                </a>

                                @if($item->status === 'selesai')
                                    <button class="btn btn-sm px-3 py-2 flex-grow-1 d-flex align-items-center justify-content-center" 
                                            style="background-color: #6c757d; color: white; border-radius: 8px;" disabled>
                                        <i class="bi bi-check-circle-fill me-1"></i> Donasi Selesai
                                    </button>
                                @else
                                    <a href="{{ route('donasi.form', $item->id_donasi) }}" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center flex-grow-1" 
                                    style="background-color: #00ADB5; color: white; border-radius: 8px;">
                                        <i class="bi bi-heart-fill me-1"></i> Donasi Sekarang
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5 rounded-4" style="background-color: #EBFFD8;">
                <i class="bi bi-heartbreak-fill mb-3" style="font-size: 2.5rem; color: #8DBCC7;"></i>
                <h5 class="fw-bold mb-2" style="color: #2c3e50;">Belum Ada Kampanye Donasi</h5>
                <p class="text-muted mb-4">Tidak ada kampanye donasi yang sesuai dengan kriteria pencarian Anda</p>
                <a href="{{ route('donasi.index') }}" class="btn px-4" style="background-color: #8DBCC7; color: white;">Reset Pencarian</a>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($donasi instanceof \Illuminate\Pagination\AbstractPaginator && $donasi->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if($donasi->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link border-0" style="color: #7f8c8d;">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link border-0" href="{{ $donasi->previousPageUrl() }}" style="color: #8DBCC7;">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach(range(1, $donasi->lastPage()) as $page)
                        <li class="page-item {{ $page == $donasi->currentPage() ? 'active' : '' }}">
                            @if($page == $donasi->currentPage())
                                <span class="page-link rounded-circle mx-1" style="background-color: #8DBCC7; border-color: #8DBCC7;">{{ $page }}</span>
                            @else
                                <a class="page-link rounded-circle mx-1 border-0" href="{{ $donasi->url($page) }}" style="color: #8DBCC7;">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($donasi->hasMorePages())
                        <li class="page-item">
                            <a class="page-link border-0" href="{{ $donasi->nextPageUrl() }}" style="color: #8DBCC7;">&raquo;</a>
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
    
    .btn-hover {
        transition: all 0.3s ease;
    }
    
    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .progress-bar-animated {
        transition: width 1.5s ease-in-out;
    }
    
    .page-item.active .page-link {
        background-color: #8DBCC7;
        border-color: #8DBCC7;
    }
    
    .page-link {
        color: #8DBCC7;
    }
    
    @media (max-width: 767.98px) {
        .card:hover {
            transform: none;
        }
    }
</style>

@push('scripts')
<script>
    function toggleTanggalInput() {
        const filterWaktu = document.getElementById('filter_waktu').value;
        const tanggalWrapper = document.getElementById('tanggal-wrapper');
        tanggalWrapper.style.display = (filterWaktu === 'tanggal') ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleTanggalInput();
        
        // Animate progress bars when they come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const progressBar = entry.target.querySelector('.progress-bar');
                    if (progressBar) {
                        const width = progressBar.style.width;
                        progressBar.style.width = '0';
                        setTimeout(() => {
                            progressBar.style.width = width;
                        }, 100);
                    }
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.progress').forEach(progress => {
            observer.observe(progress);
        });
    });
</script>
@endpush
@endsection