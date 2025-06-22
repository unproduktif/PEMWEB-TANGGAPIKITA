@extends('components.layout')

@section('content')
<div class="container py-4 py-md-5">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
        <div class="row g-0">
            {{-- Media Section --}}
            @if ($laporan->media)
            <div class="col-md-5 position-relative">
                <img src="{{ asset('storage/' . $laporan->media) }}" 
                     class="img-fluid h-100 w-100 object-fit-cover" 
                     style="min-height: 400px; object-position: center;" 
                     alt="Media Laporan">
                
                {{-- Status Badge --}}
                <div class="position-absolute top-3 end-3">
                    <span class="badge rounded-pill px-3 py-2 shadow-sm 
                        @if($laporan->status == 'verifikasi') 
                            bg-success bg-opacity-10 text-success
                        @else 
                            bg-warning bg-opacity-10 text-dark
                        @endif">
                        <i class="bi bi-shield-check me-1"></i>
                        {{ ucfirst($laporan->status) }}
                    </span>
                </div>
            </div>
            @endif

            {{-- Content Section --}}
            <div class="col-md-7 p-4 p-md-5" style="background-color: #f8f9fa;">
                {{-- Title --}}
                <h2 class="fw-bold mb-4" style="color: #2c3e50;">{{ $laporan->judul }}</h2>
                
                {{-- Metadata --}}
                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-geo-alt-fill" style="color: #EBFFD8; font-size: 1.1rem;"></i>
                        </div>
                        <div>
                            <p class="mb-0 text-muted small">Lokasi Kejadian</p>
                            <p class="mb-0 fw-medium">{{ $laporan->lokasi }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-clock-fill" style="color: #EBFFD8; font-size: 1.1rem;"></i>
                        </div>
                        <div>
                            <p class="mb-0 text-muted small">Waktu Kejadian</p>
                            <p class="mb-0 fw-medium">
                                {{ \Carbon\Carbon::parse($laporan->tgl_publish)->translatedFormat('d F Y, H:i') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-person-fill" style="color: #EBFFD8; font-size: 1.1rem;"></i>
                        </div>
                        <div>
                            <p class="mb-0 text-muted small">Pelapor</p>
                            <p class="mb-0 fw-medium">{{ $laporan->user->akun->nama ?? 'Anonim' }}</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-color: rgba(0,0,0,0.1);">

                {{-- Description --}}
                <div class="mb-4">
                    <h5 class="fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-text-paragraph me-2" style="color: #8DBCC7;"></i>
                        Deskripsi Kejadian
                    </h5>
                    <div class="ps-4">
                        <p class="text-muted mb-0" style="line-height: 1.7; text-align: justify;">
                            {{ $laporan->deskripsi }}
                        </p>
                    </div>
                </div>

                {{-- Additional Info --}}
                @if($laporan->keterangan)
                <div class="mb-4">
                    <h5 class="fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-info-circle me-2" style="color: #8DBCC7;"></i>
                        Jenis Bencana
                    </h5>
                    <div class="ps-4">
                        <p class="text-muted mb-0" style="line-height: 1.7; text-align: justify;">
                            {{ $laporan->keterangan }}
                        </p>
                    </div>
                </div>
                @endif

                <hr class="my-4" style="border-color: rgba(0,0,0,0.1);">

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ session('laporan_prev_url', route('home')) }}" class="btn btn-hover px-4 py-2 d-flex align-items-center" style="background-color: #A4CCD9; color: #2c3e50; border-radius: 8px;">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>

                    @auth
                        @if ($laporan->status === 'verifikasi' && auth()->user()->id_akun === $laporan->id_user)
                            <a href="{{ route('donasi.createCampaign', $laporan->id_laporan) }}" 
                               class="btn btn-hover px-4 py-2 d-flex align-items-center" 
                               style="background-color: #8DBCC7; color: white; border-radius: 8px;">
                                <i class="bi bi-bullseye me-2"></i> Buat Kampanye Donasi
                            </a>
                        @endif
                    @endauth
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
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }
    
    .btn-hover {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .btn-hover:active {
        transform: translateY(0);
    }
    
    @media (max-width: 767.98px) {
        .card:hover {
            transform: none;
        }
    }
</style>

@endsection