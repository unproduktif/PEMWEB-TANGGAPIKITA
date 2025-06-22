@extends('components.layout')

@section('content')
<div class="container py-4 py-md-5">

    {{-- Search and Filter Section --}}
    <div class="search-filter-container mb-4 p-4 rounded-4" style="background-color: #EBFFD8;">
        <form method="GET" action="{{ route('bencana') }}" class="row g-3 align-items-end">
            {{-- Search Input --}}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search" style="color: #8DBCC7;"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari laporan bencana..." value="{{ request('search') }}" style="border-color: #dee2e6;">
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
                            <a href="{{ route('laporan.index') }}" class="btn btn-sm btn-outline-secondary flex-grow-1">Reset</a>
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

    {{-- Laporan List --}}
    <div class="row g-4">
        @forelse ($laporans as $laporan)
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-all" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="row g-0 h-100">
                        {{-- Gambar Laporan --}}
                        <div class="col-md-4 position-relative">
                            @if ($laporan->media)
                                <img src="{{ asset('storage/' . $laporan->media) }}" class="img-fluid h-100 w-100 object-fit-cover" style="min-height: 220px;" alt="Foto Laporan">
                            @else
                                <div class="h-100 w-100 d-flex align-items-center justify-content-center" style="background-color: #C4E1E6; min-height: 220px;">
                                    <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge rounded-pill px-3 py-2 shadow-sm 
                                    @if($laporan->status == 'verifikasi') 
                                        bg-success bg-opacity-10 text-success
                                    @else 
                                        bg-secondary bg-opacity-10 text-secondary 
                                    @endif">
                                    <i class="bi bi-shield-check me-1"></i>
                                    {{ ucfirst($laporan->status) }}
                                </span>
                            </div>
                        </div>

                        {{-- Konten Laporan --}}
                        <div class="col-md-8">
                            <div class="card-body h-100 d-flex flex-column">
                                <div class="flex-grow-1">
                                    <h5 class="card-title fw-bold mb-3" style="color: #2c3e50;">{{ $laporan->judul }}</h5>
                                    
                                    <div class="d-flex flex-wrap gap-3 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                <i class="bi bi-person-fill" style="color: #EBFFD8;"></i>
                                            </div>
                                            <div>
                                                <small class="d-block text-muted">Pelapor</small>
                                                <span class="fw-medium">{{ $laporan->user->akun->nama ?? 'Anonim' }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                <i class="bi bi-geo-alt-fill" style="color: #EBFFD8;"></i>
                                            </div>
                                            <div>
                                                <small class="d-block text-muted">Lokasi</small>
                                                <span class="fw-medium">{{ $laporan->lokasi }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                <i class="bi bi-clock-fill" style="color: #EBFFD8;"></i>
                                            </div>
                                            <div>
                                                <small class="d-block text-muted">Waktu</small>
                                                <span class="fw-medium">{{ \Carbon\Carbon::parse($laporan->tgl_publish)->translatedFormat('d M Y H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <p class="card-text mb-4" style="color: #5a6a7a;">{{ Str::limit($laporan->deskripsi, 200) }}</p>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        @if($laporan->kategori)
                                            <span class="badge rounded-pill px-3 py-1" style="background-color: #A4CCD9; color: #2c3e50;">
                                                {{ $laporan->kategori }}
                                            </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('laporan.show', $laporan->id_laporan) }}" class="btn btn-sm px-3 py-2 d-flex align-items-center" style="background-color: #8DBCC7; color: white;">
                                        <i class="bi bi-eye-fill me-1"></i> Detail Laporan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="text-center py-5 rounded-4" style="background-color: #EBFFD8;">
                    <i class="bi bi-exclamation-circle-fill mb-3" style="font-size: 2.5rem; color: #8DBCC7;"></i>
                    <h5 class="fw-bold mb-2" style="color: #2c3e50;">Tidak Ada Laporan Ditemukan</h5>
                    <p class="text-muted mb-4">Tidak ada laporan yang sesuai dengan kriteria pencarian Anda</p>
                    <a href="{{ route('bencana') }}" class="btn px-4" style="background-color: #8DBCC7; color: white;">Reset Pencarian</a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($laporans instanceof \Illuminate\Pagination\LengthAwarePaginator && $laporans->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation">
                <ul class="pagination">
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

<style>
    .search-filter-container {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .btn:hover {
        opacity: 0.9;
    }
    
    .page-item.active .page-link {
        color: white !important;
    }
    
    .page-link {
        transition: all 0.3s ease;
    }
    
    .page-link:hover {
        color: #2c3e50 !important;
        background-color: #EBFFD8;
    }
</style>

@endsection

@push('scripts')
<script>
    function toggleTanggalInput() {
        const filterWaktu = document.getElementById('filter_waktu').value;
        const tanggalWrapper = document.getElementById('tanggal-wrapper');

        if (filterWaktu === 'tanggal') {
            tanggalWrapper.style.display = 'block';
        } else {
            tanggalWrapper.style.display = 'none';
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleTanggalInput();
        
        // Add animation to cards when they come into view
        const cards = document.querySelectorAll('.card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        cards.forEach(card => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    });
</script>
@endpush