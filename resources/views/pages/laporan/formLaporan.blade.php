@extends('components.layout')

@section('content')
<div class="container py-4 py-md-5">

    {{-- Hero Section --}}
    <div class="text-center mb-5 px-3">
        <h1 class="fw-bold display-5 display-md-4 mb-3" style="color: #2c3e50;">
            <span class="d-block">Laporkan Bencana,</span>
            <span class="text-gradient" style="background: linear-gradient(to right, #8DBCC7, #00ADB5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Agar Tanggapan Segera Tiba</span>
        </h1>
        <p class="lead text-muted mb-4">
            <span class="fw-medium" style="color: #2c3e50;">TanggapiKita</span> — Suaramu Adalah Aksi.
        </p>
        <div class="d-flex justify-content-center">
            <div style="width: 100px; height: 4px; background: linear-gradient(to right, #8DBCC7, #00ADB5); border-radius: 2px;"></div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" id="laporanForm">
                @csrf

                {{-- Judul Laporan --}}
                <div class="mb-4">
                    <label for="judul" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-card-heading me-2" style="color: #8DBCC7;"></i>
                        Judul Laporan
                    </label>
                    <input type="text" name="judul" id="judul" class="form-control border-1 py-3 px-3" 
                           style="border-color: #C4E1E6; border-radius: 8px;" 
                           value="{{ old('judul') }}" 
                           placeholder="Contoh: Banjir Bandang di Kelurahan Merdeka" required>
                    <div class="form-text text-muted">Buat judul yang jelas dan deskriptif</div>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-text-paragraph me-2" style="color: #8DBCC7;"></i>
                        Deskripsi Lengkap
                    </label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control border-1 py-3 px-3" 
                              style="border-color: #C4E1E6; border-radius: 8px; min-height: 150px;"
                              rows="5" placeholder="Deskripsikan kejadian dengan jelas (apa, kapan, bagaimana)" required>{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Jenis Bencana --}}
                <div class="mb-4">
                    <label for="keterangan" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-tornado me-2" style="color: #8DBCC7;"></i>
                        Jenis Bencana
                    </label>
                    <select name="keterangan" id="keterangan" class="form-select border-1 py-3 px-3" 
                            style="border-color: #C4E1E6; border-radius: 8px;" required>
                        <option value="">-- Pilih Jenis Bencana --</option>
                        <option value="Banjir" {{ old('keterangan') == 'Banjir' ? 'selected' : '' }}>Banjir</option>
                        <option value="Gempa" {{ old('keterangan') == 'Gempa' ? 'selected' : '' }}>Gempa Bumi</option>
                        <option value="Kebakaran" {{ old('keterangan') == 'Kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                        <option value="Tanah Longsor" {{ old('keterangan') == 'Tanah Longsor' ? 'selected' : '' }}>Tanah Longsor</option>
                        <option value="Lainnya" {{ old('keterangan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                {{-- Lokasi --}}
                <div class="mb-4">
                    <label for="lokasi" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-geo-alt-fill me-2" style="color: #8DBCC7;"></i>
                        Lokasi Kejadian
                    </label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control border-1 py-3 px-3" 
                           style="border-color: #C4E1E6; border-radius: 8px;" 
                           value="{{ old('lokasi') }}" 
                           placeholder="Contoh: Jl. Merdeka No. 10, Kelurahan Bahagia, Kecamatan Aman" required>
                    <div class="form-text text-muted">Sertakan alamat lengkap jika memungkinkan</div>
                </div>

                {{-- Upload Foto --}}
                <div class="mb-4">
                    <label for="media" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-camera-fill me-2" style="color: #8DBCC7;"></i>
                        Unggah Foto/Dokumentasi
                    </label>
                    <div class="file-upload-container border-1 rounded-4 p-4 text-center" 
                         style="border-color: #C4E1E6; border-style: dashed;">
                        <input type="file" name="media" id="media" class="d-none" accept="image/*">
                        <div id="filePreview" class="mb-3 d-none">
                            <img id="previewImage" src="#" alt="Preview" class="img-fluid rounded-3 mb-2" style="max-height: 200px;">
                            <button type="button" id="changeImage" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-arrow-repeat me-1"></i> Ganti Foto
                            </button>
                        </div>
                        <div id="uploadPrompt">
                            <i class="bi bi-cloud-arrow-up fs-1" style="color: #8DBCC7;"></i>
                            <p class="mb-2">Seret & lepas foto atau <span class="text-primary">klik untuk memilih</span></p>
                            <small class="text-muted d-block">Format: JPG, PNG (Maks. 5MB)</small>
                            <button type="button" id="selectFileBtn" class="btn btn-sm mt-2 px-3" 
                                    style="background-color: #A4CCD9; color: #2c3e50;">
                                <i class="bi bi-folder2-open me-1"></i> Pilih File
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between mt-5 pt-3">
                    <a href="{{ route('laporan.index') }}" class="btn btn-hover px-4 py-2" 
                       style="background-color: #EBFFD8; color: #2c3e50; border-radius: 8px;">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-hover px-4 py-2" 
                            style="background-color: #8DBCC7; color: white; border-radius: 8px;" 
                            id="submitBtn">
                        <i class="bi bi-send-fill me-2"></i> Kirim Laporan
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
    
    .file-upload-container:hover {
        border-color: #8DBCC7 !important;
        background-color: rgba(141, 188, 199, 0.05);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #8DBCC7 !important;
        box-shadow: 0 0 0 0.25rem rgba(141, 188, 199, 0.25);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File upload preview
        const mediaInput = document.getElementById('media');
        const filePreview = document.getElementById('filePreview');
        const uploadPrompt = document.getElementById('uploadPrompt');
        const previewImage = document.getElementById('previewImage');
        const selectFileBtn = document.getElementById('selectFileBtn');
        const changeImage = document.getElementById('changeImage');
        
        selectFileBtn.addEventListener('click', () => mediaInput.click());
        changeImage?.addEventListener('click', () => mediaInput.click());
        
        mediaInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    filePreview.classList.remove('d-none');
                    uploadPrompt.classList.add('d-none');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Form submission handling
        const form = document.getElementById('laporanForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat me-2"></i> Mengirim...';
        });
    });
</script>
@endsection