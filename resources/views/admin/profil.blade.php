@extends('components.admin-layout')

@section('content')
<div class="container py-4 mt-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4"> 
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body row p-4">
            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center mb-4 mb-md-0 position-relative" style="min-height: 300px;">
                <div class="position-relative" style="width: 300px; height: 300px;">
                    <!-- Foto Profil -->
                    <img src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : asset('default-profile.png') }}" 
                         class="rounded-circle border shadow-sm w-100 h-100" style="object-fit: cover;" alt="Foto Profil">
                    
                    @if(auth()->user()->foto)
                        <!-- Overlay Edit Button (Hover Effect) -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded-circle" 
                             style="background: rgba(0,0,0,0.5); opacity: 0; transition: all 0.3s ease;">
                            <button type="button" class="btn btn-outline-light rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#fotoModal">
                                <i class="bi bi-camera me-1"></i> Edit Foto
                            </button>
                        </div>
                    @else
                        <!-- Add Photo Button -->
                        <div class="position-absolute bottom-0 end-0">
                            <button type="button" class="btn btn-primary rounded-circle p-3 shadow" data-bs-toggle="modal" data-bs-target="#fotoModal">
                                <i class="bi bi-plus-lg fs-4"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-8 ps-md-4">
                <!-- Form bagian kanan tetap sama -->
                <form method="POST" action="{{ route('admin.profil.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="nama" value="{{ auth()->user()->nama }}" 
                               class="form-control rounded-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" value="{{ auth()->user()->email }}" 
                               class="form-control rounded-2" disabled>
                    </div>

                    <button class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan 
                    </button>
                </form>

                <hr class="my-4"> 

                <form method="POST" action="{{ route('admin.password.update') }}">
                    @csrf
                    @method('PATCH')

                    <h5 class="mb-3 fw-semibold">
                        <i class="bi bi-key me-1"></i> Ubah Password
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru</label>
                        <input type="password" name="password" 
                               class="form-control rounded-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" 
                               class="form-control rounded-2" required>
                    </div>

                    <button class="btn btn-warning px-4">
                        <i class="bi bi-arrow-repeat me-1"></i> Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.foto.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="fotoModalLabel">
                        {{ auth()->user()->foto ? 'Edit Foto Profil' : 'Tambah Foto Profil' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    @if(auth()->user()->foto)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hapus" id="hapusFoto" value="1">
                            <label class="form-check-label text-danger" for="hapusFoto">
                                Hapus Foto Profil
                            </label>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Hover effect for profile photo
    document.addEventListener('DOMContentLoaded', function() {
        const fotoContainer = document.querySelector('.position-relative');
        if (fotoContainer) {
            const overlay = fotoContainer.querySelector('.position-absolute.top-0');
            if (overlay) {
                fotoContainer.addEventListener('mouseenter', function() {
                    overlay.style.opacity = '1';
                });
                fotoContainer.addEventListener('mouseleave', function() {
                    overlay.style.opacity = '0';
                });
            }
        }
    });
</script>
@endsection