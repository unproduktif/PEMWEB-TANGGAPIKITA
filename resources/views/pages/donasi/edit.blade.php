@extends('components.layout')

@section('content')
<div class="container py-5">
    {{-- Hero Section --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 mb-3" style="color: #222831;">
            <span class="d-block">Kelola Kampanye</span>
            <span class="text-gradient" style="background: linear-gradient(to right, #393E46, #00ADB5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Ubah untuk Dampak Lebih Besar</span>
        </h1>
        <div class="d-flex justify-content-center">
            <div style="width: 100px; height: 4px; background: linear-gradient(to right, #393E46, #00ADB5); border-radius: 2px;"></div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color: #EEEEEE;">
        <div class="card-body p-4 p-md-5">
            <h3 class="fw-bold mb-4" style="color: #222831;">
                <i class="bi bi-pencil-square me-2" style="color: #00ADB5;"></i> Edit Kampanye Donasi
            </h3>

            @if(session('success'))
                <div class="alert alert-success rounded-3" style="background-color: #d4edda; border-color: #c3e6cb; color: #155724;">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('donasi.update', $donasi->id_donasi) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')

                {{-- Judul Donasi --}}
                <div class="mb-4">
                    <label for="judul" class="form-label fw-semibold mb-3" style="color: #222831;">
                        <i class="bi bi-card-heading me-2" style="color: #00ADB5;"></i>
                        Judul Donasi
                    </label>
                    <input type="text" name="judul" id="judul" 
                           class="form-control border-1 py-3 px-3" 
                           style="border-color: #C4E1E6; border-radius: 8px;" 
                           value="{{ old('judul', $donasi->judul) }}" 
                           placeholder="Masukkan judul kampanye donasi" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold mb-3" style="color: #222831;">
                        <i class="bi bi-text-paragraph me-2" style="color: #00ADB5;"></i>
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" id="deskripsi" 
                              class="form-control border-1 py-3 px-3" 
                              style="border-color: #C4E1E6; border-radius: 8px; min-height: 150px;"
                              rows="4" 
                              placeholder="Jelaskan tujuan dan latar belakang kampanye ini" required>{{ old('deskripsi', $donasi->deskripsi) }}</textarea>
                </div>

                <div class="row">
                    {{-- Target Donasi --}}
                    <div class="col-md-6 mb-4">
                        <label for="target" class="form-label fw-semibold mb-3" style="color: #222831;">
                            <i class="bi bi-bullseye me-2" style="color: #00ADB5;"></i>
                            Target Donasi (Rp)
                        </label>
                        <input type="number" name="target" id="target" 
                               class="form-control border-1 py-3 px-3" 
                               style="border-color: #C4E1E6; border-radius: 8px;" 
                               value="{{ old('target', $donasi->target) }}" 
                               required min="10000" 
                               placeholder="Contoh: 10000000">
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="col-md-6 mb-4">
                        <label for="tgl_mulai" class="form-label fw-semibold mb-3" style="color: #222831;">
                            <i class="bi bi-calendar-event me-2" style="color: #00ADB5;"></i>
                            Tanggal Mulai
                        </label>
                        <input type="date" name="tgl_mulai" id="tgl_mulai" 
                               class="form-control border-1 py-3 px-3" 
                               style="border-color: #C4E1E6; border-radius: 8px;" 
                               value="{{ old('tgl_mulai', $donasi->tgl_mulai) }}" required>
                    </div>

                    {{-- Tanggal Selesai --}}
                    <div class="col-md-6 mb-4">
                        <label for="tgl_selesai" class="form-label fw-semibold mb-3" style="color: #222831;">
                            <i class="bi bi-calendar-check me-2" style="color: #00ADB5;"></i>
                            Tanggal Selesai
                        </label>
                        <input type="date" name="tgl_selesai" id="tgl_selesai" 
                               class="form-control border-1 py-3 px-3" 
                               style="border-color: #C4E1E6; border-radius: 8px;" 
                               value="{{ old('tgl_selesai', $donasi->tgl_selesai) }}" required>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between mt-5 pt-3">
                    <a href="{{ route('donasi.kelola') }}" class="btn btn-hover px-4 py-2" 
                       style="background-color: #EEEEEE; color: #222831; border: 1px solid #393E46; border-radius: 8px;">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-hover px-4 py-2" 
                            style="background-color: #00ADB5; color: white; border-radius: 8px;" 
                            id="submitBtn">
                        <i class="bi bi-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .btn-hover {
        transition: all 0.3s ease;
    }
    
    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #00ADB5 !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 173, 181, 0.25);
    }
    
    .alert {
        border-left: 4px solid;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form submission handling
        const form = document.getElementById('editForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat me-2"></i> Menyimpan...';
        });
        
        // Date validation
        const tglMulai = document.getElementById('tgl_mulai');
        const tglSelesai = document.getElementById('tgl_selesai');
        
        tglMulai.addEventListener('change', function() {
            if (tglSelesai.value && this.value > tglSelesai.value) {
                alert('Tanggal mulai tidak boleh setelah tanggal selesai');
                this.value = '';
            }
        });
        
        tglSelesai.addEventListener('change', function() {
            if (tglMulai.value && this.value < tglMulai.value) {
                alert('Tanggal selesai tidak boleh sebelum tanggal mulai');
                this.value = '';
            }
        });
    });
</script>
@endsection