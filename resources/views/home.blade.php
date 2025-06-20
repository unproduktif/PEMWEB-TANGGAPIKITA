@extends('components.layout')

@section('content')

<!-- Hero Section Carousel -->
<div id="heroCarousel" class="carousel slide mb-5 position-relative" data-bs-ride="carousel">
    <div class="carousel-inner rounded-4 shadow">
        <div class="carousel-item active">
            <img src="{{ asset('images/hero1.jpg') }}" class="d-block w-100" style="height: 420px; object-fit: cover;" alt="Hero Slide 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/hero2.jpg') }}" class="d-block w-100" style="height: 420px; object-fit: cover;" alt="Hero Slide 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/hero3.jpg') }}" class="d-block w-100" style="height: 420px; object-fit: cover;" alt="Hero Slide 3">
        </div>
    </div>
    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

    <!-- Overlay Text -->
    <div class="position-absolute top-50 start-50 translate-middle text-center px-3 w-100">
        <h1 class="fw-bold display-4 text-white text-shadow">Tanggapikita</h1>
        <p class="fs-4 text-white text-shadow">
            Satu Aksi, Selamatkan Negeri: Laporkan, Edukasi, dan Berdonasi
        </p>
    </div>
</div>

<!-- Section Edukasi -->
<section class="section-padding">
    <div class="section-header">
        <h3>Edukasi Terkini</h3>
        <p>Informasi penting untuk masyarakat tentang bencana dan kesiapsiagaan</p>
    </div>

    <div class="row g-4">
        @forelse ($edukasis as $edukasi)
            <div class="col-md-4">
                <div class="card h-100">
                    @if ($edukasi->gambar)
                        <img src="{{ asset('storage/' . $edukasi->gambar) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Foto Edukasi">
                    @else
                        <img src="{{ asset('images/default-edukasi.jpg') }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Default Foto Edukasi">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $edukasi->judul }}</h5>
                        <p class="card-text">{{ Str::limit($edukasi->konten, 100) }}</p>
                        <a href="{{ route('admin.edukasi.show', $edukasi->id_edukasi) }}" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada data edukasi.</p>
        @endforelse
    </div>
</section>

<!-- Section Laporan Terverifikasi -->
<section class="section-padding">
    <div class="section-header">
        <h3>Laporan Bencana Terverifikasi</h3>
        <p>Laporan terbaru dari pengguna yang telah diverifikasi oleh tim</p>
    </div>

    <div class="row g-4">
        @forelse ($laporans as $laporan)
            <div class="col-md-4">
                <div class="card h-100">
                    @if ($laporan->media)
                        <img src="{{ asset('storage/' . $laporan->media) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Foto Laporan">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $laporan->judul }}</h5>
                        <p class="card-text">{{ Str::limit($laporan->deskripsi, 100) }}</p>
                        <p class="text-muted small">{{ $laporan->lokasi }}</p>
                        <a href="{{ route('laporan.show', $laporan->id_laporan) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada laporan terverifikasi.</p>
        @endforelse
    </div>
</section>

<!-- Section Donasi -->
<section class="section-padding">
    <div class="section-header">
        <h3>Donasi Aktif</h3>
        <p>Berpartisipasilah dalam aksi kemanusiaan melalui kampanye donasi</p>
    </div>

    <div class="row g-4">
        @forelse ($donasis as $donasi)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($donasi->laporan && $donasi->laporan->media)
                        <img src="{{ asset('storage/' . $donasi->laporan->media) }}" class="img-fluid rounded-4 w-100 h-100 object-fit-cover" alt="{{ $donasi->judul }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $donasi->judul }}</h5>
                        <p class="card-text">{{ Str::limit($donasi->deskripsi, 100) }}</p>
                        <p class="text-muted small">Target: Rp{{ number_format($donasi->target, 0, ',', '.') }}</p>
                        <a href="{{ route('donasi.show', $donasi->id_donasi) }}" class="btn btn-outline-primary btn-sm">Lihat Donasi</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada kampanye donasi aktif.</p>
        @endforelse
    </div>
</section>

@endsection
