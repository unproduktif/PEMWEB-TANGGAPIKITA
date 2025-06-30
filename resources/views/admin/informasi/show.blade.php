@extends('components.admin-layout')

@section('content')
<div class="container py-4 py-md-5">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold display-5 mb-2" style="color: #2c3e50;">
                <span class="text-gradient" style="background: linear-gradient(to right, #8DBCC7, #00ADB5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Detail Laporan Bencana</span>
            </h1>
            <p class="text-muted mb-0">
                <i class="bi bi-info-circle-fill me-1" style="color: #8DBCC7;"></i>
                Informasi lengkap tentang laporan bencana
            </p>
        </div>
        <div class="d-none d-md-block" style="width: 80px; height: 4px; background: linear-gradient(to right, #8DBCC7, #00ADB5); border-radius: 2px;"></div>
    </div>

    {{-- Content Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all">
        <div class="card-header bg-white py-3 border-0">
            <h3 class="fw-bold mb-0" style="color: #2c3e50;">
                <i class="bi bi-clipboard2-data-fill me-2" style="color: #8DBCC7;"></i>
                {{ $laporan->judul }}
            </h3>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">
                {{-- Media Column --}}
                <div class="col-lg-5">
                    @if ($laporan->media)
                        <div class="position-relative rounded-4 overflow-hidden shadow-sm" style="height: 300px;">
                            <img src="{{ asset('storage/' . $laporan->media) }}" alt="Foto Laporan"
                                class="img-fluid w-100 h-100 object-fit-cover transition-all">
                            <div class="position-absolute bottom-0 start-0 w-100 px-3 py-2" 
                                 style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                                <small class="text-white">
                                    <i class="bi bi-image-fill me-1"></i>
                                    Dokumentasi Bencana
                                </small>
                            </div>
                        </div>
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center text-center py-5 rounded-4" 
                             style="background-color: #EBFFD8; height: 300px;">
                            <i class="bi bi-image text-muted mb-3" style="font-size: 3rem;"></i>
                            <h5 class="fw-bold mb-1" style="color: #2c3e50;">Tidak Ada Foto</h5>
                            <p class="text-muted small">Tidak ada dokumentasi visual tersedia</p>
                        </div>
                    @endif
                </div>

                {{-- Details Column --}}
                <div class="col-lg-7">
                    <div class="detail-card rounded-4 p-4 h-100" style="background-color: #f8f9fa;">
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <div class="detail-icon me-3">
                                    <i class="bi bi-card-heading" style="color: #8DBCC7; font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold" style="color: #2c3e50;">Judul Laporan</h6>
                                    <p class="mb-0">{{ $laporan->judul }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-start mb-2">
                                <div class="detail-icon me-3">
                                    <i class="bi bi-text-paragraph" style="color: #8DBCC7; font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold" style="color: #2c3e50;">Deskripsi</h6>
                                    <p class="mb-0">{{ $laporan->deskripsi }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="detail-icon me-3">
                                        <i class="bi bi-exclamation-triangle" style="color: #e74c3c; font-size: 1.2rem;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold" style="color: #2c3e50;">Jenis Bencana</h6>
                                        <p class="mb-0">
                                            <span class="badge py-2 px-3" style="background-color: #C4E1E6; color: #2c3e50;">
                                                {{ ucfirst($laporan->keterangan) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="detail-icon me-3">
                                        <i class="bi bi-geo-alt" style="color: #e74c3c; font-size: 1.2rem;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold" style="color: #2c3e50;">Lokasi</h6>
                                        <p class="mb-0">{{ $laporan->lokasi }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="detail-icon me-3">
                                        <i class="bi bi-calendar-event" style="color: #8DBCC7; font-size: 1.2rem;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold" style="color: #2c3e50;">Tanggal Publish</h6>
                                        <p class="mb-0">
                                            {{ \Carbon\Carbon::parse($laporan->tgl_publish)->translatedFormat('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="detail-icon me-3">
                                        <i class="bi bi-person" style="color: #8DBCC7; font-size: 1.2rem;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold" style="color: #2c3e50;">Pelapor</h6>
                                        <p class="mb-0">
                                            {{ $laporan->user->akun->nama ?? 'Anonim' }}
                                            @if($laporan->user->akun->nama)
                                                <small class="text-muted d-block">({{ $laporan->user->akun->email }})</small>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <a href="{{ route('admin.informasi.index') }}" 
                               class="btn btn-hover d-flex align-items-center px-4 py-2"
                               style="background-color: #8DBCC7; color: white; border-radius: 8px;">
                                <i class="bi bi-arrow-left me-2"></i>
                                Kembali ke Daftar Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    
    .detail-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(140, 188, 199, 0.1);
        border-radius: 8px;
    }
    
    .detail-card {
        transition: all 0.3s ease;
    }
    
    @media (max-width: 767.98px) {
        .card:hover {
            transform: none;
        }
    }
</style>
@endsection