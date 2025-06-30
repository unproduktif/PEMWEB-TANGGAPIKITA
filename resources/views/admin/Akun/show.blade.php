@extends('components.admin-layout')

@section('content')
<div class="container py-4 py-md-5">
    {{-- Detail Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all">
        {{-- Card Header --}}
        <div class="card-header bg-white py-3 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold mb-0" style="color: #2c3e50;">
                    <i class="bi bi-person-badge me-2" style="color: #8DBCC7;"></i>
                    Detail Akun Pengguna
                </h3>
                <a href="{{ route('admin.akun.index') }}" class="btn btn-outline-secondary rounded-pill">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        {{-- Card Body --}}
        <div class="card-body p-4">
            <div class="row">
                {{-- Left Column - User Info --}}
                <div class="col-md-6">
                    <div class="mb-4">
                        {{-- Foto Profil --}}
                        @if ($user->akun->foto)
                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/' . $user->akun->foto) }}" 
                                    alt="Foto Profil" 
                                    class="rounded shadow"  
                                    style="width: 120px; aspect-ratio: 1 / 1; object-fit: cover;">
                            </div>
                        @else
                            <div class="text-center mb-4">
                                <div class="rounded shadow d-inline-flex align-items-center justify-content-center" 
                                    style="width: 120px; aspect-ratio: 1 / 1; background-color: #f0f0f0;">
                                    <i class="bi bi-person-fill" style="font-size: 3rem; color: #8DBCC7;"></i>
                                </div>
                            </div>
                        @endif

                        <h5 class="fw-bold mb-3" style="color: #2c3e50;">
                            <i class="bi bi-info-circle-fill me-2" style="color: #8DBCC7;"></i>
                            Informasi Dasar
                        </h5>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted mb-2">Nama Lengkap</label>
                            <div class="form-control bg-light border-0 py-3" style="border-radius: 12px;">
                                <i class="bi bi-person-fill me-2" style="color: #8DBCC7;"></i>
                                {{ $user->akun->nama ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted mb-2">Email</label>
                            <div class="form-control bg-light border-0 py-3" style="border-radius: 12px;">
                                <i class="bi bi-envelope-fill me-2" style="color: #8DBCC7;"></i>
                                {{ $user->akun->email ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted mb-2">Peran</label>
                            <div class="form-control bg-light border-0 py-3" style="border-radius: 12px;">
                                <i class="bi bi-person-rolodex me-2" style="color: #8DBCC7;"></i>
                                <span class="badge rounded-pill py-1 px-3" 
                                      style="background-color: {{ $user->akun->role == 'admin' ? '#8DBCC7' : '#6c757d' }}; color: white;">
                                    {{ $user->akun->role == 'admin' ? 'Administrator' : 'Pengguna Biasa' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column - Contact Info --}}
                <div class="col-md-6">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: #2c3e50;">
                            <i class="bi bi-telephone-fill me-2" style="color: #8DBCC7;"></i>
                            Informasi Kontak
                        </h5>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted mb-2">Nomor Handphone</label>
                            <div class="form-control bg-light border-0 py-3" style="border-radius: 12px;">
                                <i class="bi bi-phone-fill me-2" style="color: #8DBCC7;"></i>
                                {{ $user->akun->no_hp ?? '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted mb-2">Alamat Lengkap</label>
                            <div class="form-control bg-light border-0 py-3" style="border-radius: 12px; min-height: 100px;">
                                <i class="bi bi-geo-alt-fill me-2" style="color: #8DBCC7;"></i>
                                {{ $user->akun->alamat ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Address Section --}}
            <div class="mb-4">
                <h5 class="fw-bold mb-3" style="color: #2c3e50;">
                    <i class="bi bi-geo-fill me-2" style="color: #8DBCC7;"></i>
                    Detail Alamat
                </h5>
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted mb-2">Kode Pos</label>
                        <div class="form-control bg-light border-0 py-3" style="border-radius: 12px;">
                            <i class="bi bi-mailbox me-2" style="color: #8DBCC7;"></i>
                            {{ $user->kode_pos ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted mb-2">Kota</label>
                        <div class="form-control bg-light border-0 py-3" style="border-radius: 12px;">
                            <i class="bi bi-building me-2" style="color: #8DBCC7;"></i>
                            {{ $user->kota ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted mb-2">Provinsi</label>
                        <div class="form-control bg-light border-0 py-3" style="border-radius: 12px;">
                            <i class="bi bi-map me-2" style="color: #8DBCC7;"></i>
                            {{ $user->provinsi ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex justify-content-end gap-3 mt-5 pt-3">
                <a href="{{ route('admin.akun.edit', $user->id_user) }}" 
                   class="btn btn-hover rounded-pill px-4 py-2"
                   style="background-color: #FFC107; color: white;">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
                <form action="{{ route('admin.akun.destroy', $user->id_user) }}" method="POST" 
                      >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-hover rounded-pill px-4 py-2"
                            style="background-color: #DC3545; color: white;">
                        <i class="bi bi-trash-fill me-1"></i> Hapus
                    </button>
                </form>
                <a href="{{ route('admin.akun.index') }}" class="btn btn-hover px-4 py-2 d-flex align-items-center" style="background-color: #A4CCD9; color: #2c3e50; border-radius: 8px;">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
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
    
    @media (max-width: 767.98px) {
        .card:hover {
            transform: none;
        }
    }
</style>
@endsection