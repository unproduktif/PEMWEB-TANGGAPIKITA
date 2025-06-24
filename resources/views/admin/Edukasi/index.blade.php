@extends('components.admin-layout')

@section('content')
<div class="container py-4 py-md-5">
    {{-- Create Button --}}
    <div class="d-flex justify-content-between align-items-center mb-4 mb-md-5">
        @auth
            <a href="{{ route('admin.edukasi.create') }}" class="btn btn-hover px-4 py-2 d-flex align-items-center" style="background-color: #8DBCC7; color: white; border-radius: 8px;">
                <i class="bi bi-plus-lg me-2"></i> Tambah Konten
            </a>
        @else
            <a href="#" id="btn-tambah-edukasi" class="btn btn-hover px-4 py-2 d-flex align-items-center" style="background-color: #8DBCC7; color: white; border-radius: 8px;">
                <i class="bi bi-plus-lg me-2"></i> Tambah Konten
            </a>
        @endauth
    </div>

    {{-- Content Section --}}
    @auth
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @forelse ($edukasis as $edukasi)
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 transition-all">
            <div class="row g-0">
                @if($edukasi->gambar)
                <div class="col-md-4 position-relative">
                    <img src="{{ asset('storage/' . $edukasi->gambar) }}" class="img-fluid h-100 w-100 object-fit-cover" style="min-height: 200px;" alt="Gambar Edukasi">
                    <div class="position-absolute top-3 start-3">
                        <span class="badge rounded-pill px-3 py-2 shadow-sm bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ $edukasi->admin->nama ?? 'Admin' }}
                        </span>
                    </div>
                </div>
                @endif
                <div class="col-md-8">
                    <div class="card-body p-4 h-100 d-flex flex-column">
                        <div class="flex-grow-1">
                            <h4 class="card-title fw-bold mb-3" style="color: #2c3e50;">{{ $edukasi->judul }}</h4>
                            
                            <div class="d-flex flex-wrap gap-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                        <i class="bi bi-calendar-event-fill" style="color: #8DBCC7;"></i>
                                    </div>
                                    <div>
                                        <small class="d-block text-muted">Tanggal Publikasi</small>
                                        <span class="fw-medium">{{ $edukasi->created_at->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                        <i class="bi bi-card-text" style="color: #8DBCC7;"></i>
                                    </div>
                                    <div>
                                        <small class="d-block text-muted">Konten</small>
                                        <span class="fw-medium">{{ Str::limit(strip_tags($edukasi->konten)), 50 }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-muted mb-4" style="line-height: 1.6;">{{ Str::limit(strip_tags($edukasi->konten)), 180 }}</p>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.edukasi.show', $edukasi->id_edukasi) }}" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #e3f2fd; color: #2c3e50; border-radius: 8px;">
                                <i class="bi bi-eye-fill me-1"></i> Detail
                            </a>
                            <a href="{{ route('admin.edukasi.edit', $edukasi->id_edukasi) }}" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #fff8e1; color: #2c3e50; border-radius: 8px;">
                                <i class="bi bi-pencil-fill me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.edukasi.destroy', $edukasi->id_edukasi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus konten ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #ffebee; color: #c62828; border-radius: 8px;">
                                    <i class="bi bi-trash-fill me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5 rounded-4" style="background-color: #e3f2fd;">
            <i class="bi bi-journal-text mb-3" style="font-size: 2.5rem; color: #3a7bd5;"></i>
            <h5 class="fw-bold mb-2" style="color: #2c3e50;">Belum Ada Konten Edukasi</h5>
            <p class="text-muted mb-4">Mulai membuat konten edukasi pertama Anda</p>
        </div>
        @endforelse

        @if(method_exists($edukasis, 'links'))
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{ $edukasis->links() }}
                </ul>
            </nav>
        </div>
        @endif

    @else
    {{-- Unauthenticated State --}}
    <div class="text-center py-5 rounded-4" style="background-color: #e3f2fd;">
        <i class="bi bi-shield-lock-fill mb-3" style="font-size: 2.5rem; color: #3a7bd5;"></i>
        <h5 class="fw-bold mb-2" style="color: #2c3e50;">Akses Terbatas</h5>
        <p class="text-muted mb-4">Silakan login sebagai administrator untuk mengakses halaman ini</p>
        <a href="{{ route('login') }}" class="btn px-4 py-2" style="background-color: #3a7bd5; color: white;">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login Sekarang
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
    
    .pagination .page-item.active .page-link {
        background-color: #3a7bd5;
        border-color: #3a7bd5;
    }
    
    .pagination .page-link {
        color: #3a7bd5;
    }
    
    @media (max-width: 767.98px) {
        .card:hover {
            transform: none;
        }
    }
</style>

<script>
    // Handle create button for non-logged in users
    document.getElementById('btn-tambah-edukasi')?.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Login Diperlukan',
            text: 'Anda harus login sebagai administrator untuk menambahkan konten edukasi.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Login Sekarang',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3a7bd5',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    });
</script>
@endsection