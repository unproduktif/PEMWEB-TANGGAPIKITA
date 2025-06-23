@extends('components.admin-layout')

@section('content')
<div class="container py-4 py-md-5">
    {{-- Form Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all">
        <div class="card-header bg-white py-3 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold mb-0" style="color: #2c3e50;">
                    <i class="bi bi-person-plus-fill me-2" style="color: #8DBCC7;"></i>
                    Tambah Akun Pengguna
                </h3>
                <a href="{{ route('admin.akun.index') }}" class="btn btn-outline-secondary rounded-pill">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.akun.store') }}" method="POST">
                @csrf

                {{-- Basic Information Section --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-info-circle-fill me-2" style="color: #8DBCC7;"></i>
                        Informasi Dasar
                    </h5>
                    
                    <div class="row g-3">
                        {{-- Name --}}
                        <div class="col-md-6">
                            <label for="nama" class="form-label fw-semibold text-muted mb-2">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-person-fill" style="color: #8DBCC7;"></i>
                                </span>
                                <input type="text" name="nama" id="nama" class="form-control border-0 bg-light" 
                                       value="{{ old('nama') }}" required style="border-radius: 12px;" placeholder="Masukkan nama lengkap">
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold text-muted mb-2">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-envelope-fill" style="color: #8DBCC7;"></i>
                                </span>
                                <input type="email" name="email" id="email" class="form-control border-0 bg-light" 
                                       value="{{ old('email') }}" required style="border-radius: 12px;" placeholder="Masukkan alamat email">
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold text-muted mb-2">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-lock-fill" style="color: #8DBCC7;"></i>
                                </span>
                                <input type="password" name="password" id="password" class="form-control border-0 bg-light" 
                                       required style="border-radius: 12px;" placeholder="Buat password">
                                <button type="button" class="btn bg-light border-0 toggle-password" style="border-radius: 12px;">
                                    <i class="bi bi-eye-fill" style="color: #8DBCC7;"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Password Confirmation --}}
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold text-muted mb-2">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-lock-fill" style="color: #8DBCC7;"></i>
                                </span>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="form-control border-0 bg-light" required style="border-radius: 12px;" 
                                       placeholder="Ulangi password">
                                <button type="button" class="btn bg-light border-0 toggle-password" style="border-radius: 12px;">
                                    <i class="bi bi-eye-fill" style="color: #8DBCC7;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-color: rgba(140, 188, 199, 0.3);">

                {{-- Contact Information Section --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-telephone-fill me-2" style="color: #8DBCC7;"></i>
                        Informasi Kontak
                    </h5>
                    
                    <div class="row g-3">
                        {{-- Phone Number --}}
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label fw-semibold text-muted mb-2">Nomor Handphone</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-phone-fill" style="color: #8DBCC7;"></i>
                                </span>
                                <input type="text" name="no_hp" id="no_hp" class="form-control border-0 bg-light" 
                                       value="{{ old('no_hp') }}" style="border-radius: 12px;" placeholder="Masukkan nomor handphone">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-color: rgba(140, 188, 199, 0.3);">

                {{-- Address Information Section --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-geo-alt-fill me-2" style="color: #8DBCC7;"></i>
                        Informasi Alamat
                    </h5>
                    
                    <div class="row g-3">
                        {{-- Address --}}
                        <div class="col-12">
                            <label for="alamat" class="form-label fw-semibold text-muted mb-2">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" class="form-control border-0 bg-light" rows="2" 
                                      style="border-radius: 12px; resize: none;" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                        </div>

                        {{-- Postal Code --}}
                        <div class="col-md-4">
                            <label for="kode_pos" class="form-label fw-semibold text-muted mb-2">Kode Pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" class="form-control border-0 bg-light" 
                                   value="{{ old('kode_pos') }}" style="border-radius: 12px;" placeholder="Masukkan kode pos">
                        </div>

                        {{-- City --}}
                        <div class="col-md-4">
                            <label for="kota" class="form-label fw-semibold text-muted mb-2">Kota</label>
                            <input type="text" name="kota" id="kota" class="form-control border-0 bg-light" 
                                   value="{{ old('kota') }}" style="border-radius: 12px;" placeholder="Masukkan kota">
                        </div>

                        {{-- Province --}}
                        <div class="col-md-4">
                            <label for="provinsi" class="form-label fw-semibold text-muted mb-2">Provinsi</label>
                            <input type="text" name="provinsi" id="provinsi" class="form-control border-0 bg-light" 
                                   value="{{ old('provinsi') }}" style="border-radius: 12px;" placeholder="Masukkan provinsi">
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="d-flex justify-content-end mt-5 pt-3">
                    <button type="submit" class="btn btn-hover rounded-pill px-4 py-2"
                            style="background: linear-gradient(to right, #8DBCC7, #00ADB5); color: white;">
                        <i class="bi bi-save-fill me-1"></i> Simpan Akun
                    </button>
                </div>
            </form>
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
    
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(140, 188, 199, 0.25);
        border-color: #8DBCC7;
    }
    
    .input-group-text {
        transition: all 0.3s ease;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentNode.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye-fill');
                    icon.classList.add('bi-eye-slash-fill');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash-fill');
                    icon.classList.add('bi-eye-fill');
                }
            });
        });
        
        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak sama!');
                password.focus();
            }
        });
    });
</script>
@endsection