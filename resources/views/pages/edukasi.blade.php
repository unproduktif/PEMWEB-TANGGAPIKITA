@extends('components.layout')

@section('content')
<div class="container py-4 py-md-5">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all">
        <div class="row g-0">
            {{-- Image Section --}}
            @if ($edukasi->gambar)
            <div class="col-md-5 position-relative">
                <img src="{{ asset('storage/' . $edukasi->gambar) }}" 
                     class="img-fluid h-100 w-100 object-fit-cover" 
                     style="min-height: 400px; object-position: center;" 
                     alt="Gambar Edukasi">
                
                {{-- Admin Badge --}}
                <div class="position-absolute top-3 start-3">
                    <span class="badge rounded-pill px-3 py-2 shadow-sm bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-person-fill me-1"></i>
                        Admin
                    </span>
                </div>
            </div>
            @endif

            {{-- Content Section --}}
            <div class="col-md-{{ $edukasi->gambar ? '7' : '12' }} p-4 p-md-5" style="background-color: #f8f9fa;">
                {{-- Title --}}
                <h2 class="fw-bold mb-4" style="color: #2c3e50;">{{ $edukasi->judul }}</h2>
                
                {{-- Metadata --}}
                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-person-fill" style="color: #8DBCC7; font-size: 1.1rem;"></i>
                        </div>
                        <div>
                            <p class="mb-0 text-muted small">Penulis</p>
                            <p class="mb-0 fw-medium">{{ $edukasi->admin->nama ?? 'Admin' }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-clock-fill" style="color: #8DBCC7; font-size: 1.1rem;"></i>
                        </div>
                        <div>
                            <p class="mb-0 text-muted small">Dipublikasikan</p>
                            <p class="mb-0 fw-medium">
                                {{ \Carbon\Carbon::parse($edukasi->created_at)->translatedFormat('d F Y, H:i') }}
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-color: rgba(0,0,0,0.1);">

                {{-- Content --}}
                <div class="mb-4">
                    <h5 class="fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-book me-2" style="color: #8DBCC7;"></i>
                        Konten Edukasi
                    </h5>
                    <div class="ps-4">
                        <div class="content-text" style="line-height: 1.7; text-align: justify;">
                            {!! $edukasi->konten !!}
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-color: rgba(0,0,0,0.1);">

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('home') }}" class="btn btn-hover px-4 py-2 d-flex align-items-center" style="background-color: #A4CCD9; color: #2c3e50; border-radius: 8px;">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
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
    
    .content-text img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1rem 0;
    }
    
    .content-text table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
    }
    
    .content-text table, 
    .content-text th, 
    .content-text td {
        border: 1px solid #dee2e6;
    }
    
    .content-text th, 
    .content-text td {
        padding: 0.75rem;
        text-align: left;
    }
    
    .content-text th {
        background-color: #f8f9fa;
    }
    
    @media (max-width: 767.98px) {
        .card:hover {
            transform: none;
        }
        
        .row.g-0 {
            flex-direction: column;
        }
        
        .col-md-5, .col-md-7 {
            width: 100%;
        }
        
        .col-md-5 img {
            min-height: 250px;
        }
    }
</style>
@endsection