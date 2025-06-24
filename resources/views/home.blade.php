@extends('components.layout')

@section('content')

<!-- Hero Section Carousel -->
<div id="heroCarousel" class="carousel slide mb-4 mb-md-5 position-relative" data-bs-ride="carousel">
    <div class="carousel-inner rounded-3 rounded-md-4 shadow-lg" style="overflow: hidden;">
        <div class="carousel-item active">
            <img src="{{ asset('images/hero1.jpg') }}" class="d-block w-100" style="height: 300px; height-md: 500px; object-fit: cover; filter: brightness(0.7);" alt="Hero Slide 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/hero2.jpg') }}" class="d-block w-100" style="height: 300px; height-md: 500px; object-fit: cover; filter: brightness(0.7);" alt="Hero Slide 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/hero3.jpg') }}" class="d-block w-100" style="height: 300px; height-md: 500px; object-fit: cover; filter: brightness(0.7);" alt="Hero Slide 3">
        </div>
    </div>
    
    <!-- Controls -->
    <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" style="background-color: rgba(164, 204, 217, 0.8); border-radius: 50%; padding: 1.2rem;" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" style="background-color: rgba(164, 204, 217, 0.8); border-radius: 50%; padding: 1.2rem;" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

    <!-- Overlay Text -->
    <div class="position-absolute top-50 start-50 translate-middle text-center px-3 w-100">
        <h1 class="fw-bold display-5 display-md-4 text-white mb-2 mb-md-3" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5); letter-spacing: 0.5px;">Tanggapikita</h1>
        <p class="fs-5 fs-md-4 text-white mb-3 mb-md-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
            Satu Aksi, Selamatkan Negeri: Laporkan, Edukasi, dan Berdonasi
        </p>
        <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 gap-md-3 mt-2 mt-md-3 px-2">
            <a href="{{ route('laporan.index') }}" class="btn px-3 py-2 px-md-4 py-md-2 btn-laporan" style="background-color: #A4CCD9; color: #2c3e50; border-radius: 50px; font-weight: 500; white-space: nowrap;">Buat Laporan</a>
            <a href="/donasi" class="btn px-3 py-2 px-md-4 py-md-2 btn-donasi" style="background-color: rgba(255,255,255,0.2); color: white; border: 2px solid white; border-radius: 50px; font-weight: 500; white-space: nowrap;">Donasi Sekarang</a>
        </div>
    </div>
</div>

<!-- Main Content Sections -->
<div class="container py-3 py-md-5">

    <!-- Section Edukasi -->
    <section class="mb-4 mb-md-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end mb-3 mb-md-4 gap-2">
            <div>
                <h3 class="fw-bold mb-1 mb-md-2" style="color: #2c3e50; font-size: 1.25rem; font-size-md: 1.5rem;">Edukasi Terkini</h3>
                <p class="mb-0" style="color: #7f8c8d; font-size: 0.875rem; font-size-md: 1rem;">Informasi penting untuk masyarakat tentang bencana dan kesiapsiagaan</p>
            </div>
        </div>

        <div class="row g-3 g-md-4">
            @forelse ($edukasis as $edukasi)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 10px; border-radius-md: 12px; overflow: hidden; transition: transform 0.3s;">
                        <div style="height: 160px; height-md: 200px; overflow: hidden;">
                            @if ($edukasi->gambar)
                                <img src="{{ asset('storage/' . $edukasi->gambar) }}" class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.5s;" alt="Foto Edukasi">
                            @else
                                <img src="{{ asset('images/default-edukasi.jpg') }}" class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.5s;" alt="Default Foto Edukasi">
                            @endif
                        </div>
                        <div class="card-body p-3 p-md-3">
                            <div class="d-flex justify-content-between align-items-start mb-1 mb-md-2">
                                <h5 class="card-title mb-0" style="color: #2c3e50; font-size: 1rem; font-size-md: 1.125rem;">{{ Str::limit($edukasi->judul, 50) }}</h5>
                                <span class="badge" style="background-color: #C4E1E6; color: #2c3e50; font-size: 0.75rem; font-size-md: 0.875rem;">Edukasi</span>
                            </div>
                            <p class="card-text text-muted mb-2 mb-md-3" style="font-size: 0.875rem; font-size-md: 1rem;">{{ Str::limit($edukasi->konten, 80) }}</p>
                            <a href="{{ route('admin.edukasi.show', $edukasi->id_edukasi) }}" class="btn btn-sm px-2 px-md-3 py-1" style="background-color: #A4CCD9; color: #2c3e50; border-radius: 50px; font-size: 0.875rem; font-size-md: 1rem;">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-3 py-md-4" style="background-color: #EBFFD8; border-radius: 10px; border-radius-md: 12px;">
                        <i class="bi bi-info-circle-fill" style="color: #8DBCC7; font-size: 1.5rem; font-size-md: 2rem;"></i>
                        <p class="mt-2 mt-md-3 mb-0" style="color: #7f8c8d; font-size: 0.875rem; font-size-md: 1rem;">Belum ada data edukasi.</p>
                    </div>
                </div>
            @endforelse
        </div>
        <!-- Pagination links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $edukasis->links('pagination::bootstrap-5') }}
        </div>
    </section>

    <!-- Section Laporan Terverifikasi -->
    <section class="mb-4 mb-md-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end mb-3 mb-md-4 gap-2">
            <div>
                <h3 class="fw-bold mb-1 mb-md-2" style="color: #2c3e50; font-size: 1.25rem; font-size-md: 1.5rem;">Laporan Bencana Terverifikasi</h3>
                <p class="mb-0" style="color: #7f8c8d; font-size: 0.875rem; font-size-md: 1rem;">Laporan terbaru dari pengguna yang telah diverifikasi oleh tim</p>
            </div>
            <a href="/bencana" class="text-decoration-none" style="color: #8DBCC7; font-size: 0.875rem; font-size-md: 1rem;">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row g-3 g-md-4">
            @forelse ($laporans as $laporan)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 10px; border-radius-md: 12px; overflow: hidden; transition: transform 0.3s;">
                        @if ($laporan->media)
                            <div style="height: 160px; height-md: 200px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $laporan->media) }}" class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.5s;" alt="Foto Laporan">
                            </div>
                        @endif
                        <div class="card-body p-3 p-md-3">
                            <div class="d-flex justify-content-between align-items-start mb-1 mb-md-2">
                                <h5 class="card-title mb-0" style="color: #2c3e50; font-size: 1rem; font-size-md: 1.125rem;">{{ Str::limit($laporan->judul, 50) }}</h5>
                                <span class="badge" style="background-color: #EBFFD8; color: #2c3e50; font-size: 0.75rem; font-size-md: 0.875rem;">Terverifikasi</span>
                            </div>
                            <p class="card-text text-muted mb-1 mb-md-2" style="font-size: 0.875rem; font-size-md: 1rem;">{{ Str::limit($laporan->deskripsi, 80) }}</p>
                            <div class="d-flex align-items-center mb-2 mb-md-3">
                                <i class="bi bi-geo-alt-fill me-1 me-md-2" style="color: #8DBCC7; font-size: 0.875rem;"></i>
                                <small class="text-muted" style="font-size: 0.875rem; font-size-md: 1rem;">{{ Str::limit($laporan->lokasi, 30) }}</small>
                            </div>
                            <a href="{{ route('laporan.show', $laporan->id_laporan) }}" class="btn btn-sm px-2 px-md-3 py-1" style="background-color: #A4CCD9; color: #2c3e50; border-radius: 50px; font-size: 0.875rem; font-size-md: 1rem;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-3 py-md-4" style="background-color: #EBFFD8; border-radius: 10px; border-radius-md: 12px;">
                        <i class="bi bi-info-circle-fill" style="color: #8DBCC7; font-size: 1.5rem; font-size-md: 2rem;"></i>
                        <p class="mt-2 mt-md-3 mb-0" style="color: #7f8c8d; font-size: 0.875rem; font-size-md: 1rem;">Belum ada laporan terverifikasi.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Section Donasi -->
    <section class="mb-4 mb-md-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end mb-3 mb-md-4 gap-2">
            <div>
                <h3 class="fw-bold mb-1 mb-md-2" style="color: #2c3e50; font-size: 1.25rem; font-size-md: 1.5rem;">Donasi Aktif</h3>
                <p class="mb-0" style="color: #7f8c8d; font-size: 0.875rem; font-size-md: 1rem;">Berpartisipasilah dalam aksi kemanusiaan melalui kampanye donasi</p>
            </div>
            <a href="/donasi" class="text-decoration-none" style="color: #8DBCC7; font-size: 0.875rem; font-size-md: 1rem;">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row g-3 g-md-4">
            @forelse ($donasis as $donasi)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 10px; border-radius-md: 12px; overflow: hidden; transition: transform 0.3s;">
                        @if($donasi->laporan && $donasi->laporan->media)
                            <div style="height: 160px; height-md: 200px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $donasi->laporan->media) }}" class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.5s;" alt="{{ $donasi->judul }}">
                            </div>
                        @endif
                        <div class="card-body p-3 p-md-3">
                            <h5 class="card-title mb-1 mb-md-2" style="color: #2c3e50; font-size: 1rem; font-size-md: 1.125rem;">{{ Str::limit($donasi->judul, 50) }}</h5>
                            <p class="card-text text-muted mb-2 mb-md-3" style="font-size: 0.875rem; font-size-md: 1rem;">{{ Str::limit($donasi->deskripsi, 80) }}</p>
                            
                            <div class="mb-2 mb-md-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <small class="text-muted" style="font-size: 0.75rem; font-size-md: 0.875rem;">Terkumpul</small>
                                    <small class="fw-bold" style="color: #8DBCC7; font-size: 0.75rem; font-size-md: 0.875rem;">Rp{{ number_format($donasi->total ?? 0, 0, ',', '.') }}</small>
                                </div>
                                @php
                                    $progress = $donasi->target > 0 ? round(($donasi->total / $donasi->target) * 100, 1) : 0;
                                @endphp
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small class="text-muted">Progress Donasi</small>
                                        <small class="text-muted">{{ $progress }}%</small>
                                    </div>
                                    <div class="progress" style="height: 6px; background-color: #C4E1E6;">
                                        <div class="progress-bar" 
                                            role="progressbar" 
                                            style="width: {{ $progress }}%; background-color: #00ADB5;" 
                                            aria-valuenow="{{ $progress }}" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <small class="text-muted" style="font-size: 0.75rem; font-size-md: 0.875rem;">Target</small>
                                    <small class="text-muted" style="font-size: 0.75rem; font-size-md: 0.875rem;">Rp{{ number_format($donasi->target, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            
                            <a href="{{ route('donasi.show', $donasi->id_donasi) }}" class="btn btn-sm px-2 px-md-3 py-1 w-100" style="background-color: #A4CCD9; color: #2c3e50; border-radius: 50px; font-size: 0.875rem; font-size-md: 1rem;">Donasi Sekarang</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-3 py-md-4" style="background-color: #EBFFD8; border-radius: 10px; border-radius-md: 12px;">
                        <i class="bi bi-info-circle-fill" style="color: #8DBCC7; font-size: 1.5rem; font-size-md: 2rem;"></i>
                        <p class="mt-2 mt-md-3 mb-0" style="color: #7f8c8d; font-size: 0.875rem; font-size-md: 1rem;">Belum ada kampanye donasi aktif.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
</div>

<style>
    @media (max-width: 767.98px) {
        /* Mobile-specific adjustments */
        #heroCarousel {
            margin-bottom: 1.5rem;
        }
        .carousel-item img {
            height: 250px !important;
        }
        .hero-text h1 {
            font-size: 2rem !important;
        }
        .hero-text p {
            font-size: 1rem !important;
        }
        .section-header h3 {
            font-size: 1.3rem !important;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        /* Tablet-specific adjustments */
        .carousel-item img {
            height: 400px !important;
        }
    }

    /* Card hover effect for devices with hover capability */
    @media (hover: hover) {
        .card:hover {
            transform: translateY(-5px);
        }
        .card img:hover {
            transform: scale(1.05);
        }
    }

    /* Button animations */
    .btn-laporan {
        transition: all 0.3s ease;
    }
    .btn-laporan:hover {
        background-color: #8DBCC7 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-donasi {
        transition: all 0.3s ease;
    }
    .btn-donasi:hover {
        background-color: rgba(255, 255, 255, 0.4) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

@endsection