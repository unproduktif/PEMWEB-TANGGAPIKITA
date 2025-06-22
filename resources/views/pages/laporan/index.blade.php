@extends('components.layout')

@section('content')
<div class="container py-4 py-md-5">

    {{-- Hero Section --}}
    <div class="text-center mb-5 px-3">
        <h1 class="fw-bold display-5 display-md-4 mb-3" style="color: #2c3e50;">
            <span class="d-block">Suarakan Kebenaran,</span>
            <span class="text-gradient" style="background: linear-gradient(to right, #8DBCC7, #00ADB5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Laporkan Hari Ini</span>
        </h1>
        <p class="lead text-muted mb-4">
            <span class="fw-medium" style="color: #2c3e50;">TanggapiKita</span> — Suara Anda, Tindakan Kami.
        </p>
        <div class="d-flex justify-content-center">
            <div style="width: 100px; height: 4px; background: linear-gradient(to right, #8DBCC7, #00ADB5); border-radius: 2px;"></div>
        </div>
    </div>

    {{-- Create Button --}}
    <div class="d-flex justify-content-between align-items-center mb-4 mb-md-5">
        <h3 class="fw-bold mb-0" style="color: #2c3e50;">Laporan Anda</h3>
        @auth
            <a href="{{ route('laporan.create') }}" class="btn btn-hover px-4 py-2 d-flex align-items-center" style="background-color: #8DBCC7; color: white; border-radius: 8px;">
                <i class="bi bi-plus-lg me-2"></i> Buat Laporan Baru
            </a>
        @else
            <a href="#" id="btn-buat-laporan" class="btn btn-hover px-4 py-2 d-flex align-items-center" style="background-color: #8DBCC7; color: white; border-radius: 8px;">
                <i class="bi bi-plus-lg me-2"></i> Buat Laporan Baru
            </a>
        @endauth
    </div>

    {{-- Laporan List --}}
    @auth
        @forelse ($laporan as $item)
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 transition-all">
            <div class="row g-0">
                @if($item->media)
                <div class="col-md-4 position-relative">
                            @if ($item->media)
                                <img src="{{ asset('storage/' . $item->media) }}" class="img-fluid h-100 w-100 object-fit-cover" style="min-height: 220px;" alt="Foto Laporan">
                            @else
                                <div class="h-100 w-100 d-flex align-items-center justify-content-center" style="background-color: #C4E1E6; min-height: 220px;">
                                    <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge rounded-pill px-3 py-2 shadow-sm 
                                    @if($item->status == 'verifikasi') 
                                        bg-success bg-opacity-10 text-success
                                    @else 
                                        bg-secondary bg-opacity-10 text-secondary 
                                    @endif">
                                    <i class="bi bi-shield-check me-1"></i>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        </div>
                @endif
                <div class="col-md-8">
                    <div class="card-body p-4 h-100 d-flex flex-column">
                        <div class="flex-grow-1">
                            <h4 class="card-title fw-bold mb-3" style="color: #2c3e50;">{{ $item->judul }}</h4>
                            
                            <div class="d-flex flex-wrap gap-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                        <i class="bi bi-geo-alt-fill" style="color: #EBFFD8;"></i>
                                    </div>
                                    <div>
                                        <small class="d-block text-muted">Lokasi</small>
                                        <span class="fw-medium">{{ $item->lokasi }}</span>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                        <i class="bi bi-calendar-event-fill" style="color: #EBFFD8;"></i>
                                    </div>
                                    <div>
                                        <small class="d-block text-muted">Tanggal</small>
                                        <span class="fw-medium">{{ \Carbon\Carbon::parse($item->tgl_publish)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-muted mb-4" style="line-height: 1.6;">{{ Str::limit($item->deskripsi, 180) }}</p>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('laporan.show', $item->id_laporan) }}" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #A4CCD9; color: #2c3e50; border-radius: 8px;">
                                <i class="bi bi-eye-fill me-1"></i> Detail
                            </a>
                            <a href="{{ route('laporan.edit', $item->id_laporan) }}" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #EBFFD8; color: #2c3e50; border-radius: 8px;">
                                <i class="bi bi-pencil-fill me-1"></i> Edit
                            </a>
                            <form action="{{ route('laporan.destroy', $item->id_laporan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #FFEBEE; color: #C62828; border-radius: 8px;">
                                    <i class="bi bi-trash-fill me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5 rounded-4" style="background-color: #EBFFD8;">
            <i class="bi bi-file-earmark-excel-fill mb-3" style="font-size: 2.5rem; color: #8DBCC7;"></i>
            <h5 class="fw-bold mb-2" style="color: #2c3e50;">Belum Ada Laporan</h5>
            <p class="text-muted mb-4">Anda belum membuat laporan apapun</p>
            <a href="{{ route('laporan.create') }}" class="btn px-4 py-2" style="background-color: #8DBCC7; color: white;">
                <i class="bi bi-plus-lg me-1"></i> Buat Laporan Pertama
            </a>
        </div>
        @endforelse
    @else
    <div class="text-center py-5 rounded-4" style="background-color: #EBFFD8;">
        <i class="bi bi-shield-lock-fill mb-3" style="font-size: 2.5rem; color: #8DBCC7;"></i>
        <h5 class="fw-bold mb-2" style="color: #2c3e50;">Akses Terbatas</h5>
        <p class="text-muted mb-4">Silakan login terlebih dahulu untuk melihat atau membuat laporan</p>
        <a href="{{ route('login') }}" class="btn px-4 py-2 me-2" style="background-color: #8DBCC7; color: white;">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login
        </a>
        <a href="{{ route('register') }}" class="btn px-4 py-2" style="background-color: #A4CCD9; color: #2c3e50;">
            <i class="bi bi-person-plus me-1"></i> Daftar
        </a>
    </div>
    @endauth
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

<script>
    // Handle create report button for non-logged in users
    document.getElementById('btn-buat-laporan')?.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Login Diperlukan',
            text: 'Anda harus login terlebih dahulu untuk membuat laporan.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Login Sekarang',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#8DBCC7',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    });
</script>
@endsection