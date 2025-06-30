@extends('components.admin-layout')

@section('content')
<div class="container py-4 py-md-5">

    {{-- Header Section --}}
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('admin.edukasi.index') }}" class="btn btn-outline-secondary btn-hover me-3 rounded-circle" style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="fw-bold mb-0" style="color: #2c3e50;">
            <i class="bi bi-pencil-square me-2" style="color: #8DBCC7;"></i>
            Edit Konten Edukasi
        </h2>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.edukasi.update', $edukasi->id_edukasi) }}" method="POST" enctype="multipart/form-data" id="editForm">
                @csrf
                @method('PUT')

                {{-- Judul Edukasi --}}
                <div class="mb-4">
                    <label for="judul" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-card-heading me-2" style="color: #8DBCC7;"></i>
                        Judul Edukasi
                    </label>
                    <input type="text" name="judul" id="judul" class="form-control border-1 py-3 px-3" 
                           style="border-color: #C4E1E6; border-radius: 8px;" 
                           value="{{ old('judul', $edukasi->judul) }}" 
                           placeholder="Masukkan judul edukasi yang menarik" required>
                </div>

                {{-- Konten Edukasi --}}
                <div class="mb-4">
                    <label for="konten" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-text-paragraph me-2" style="color: #8DBCC7;"></i>
                        Konten Edukasi
                    </label>
                    <textarea name="konten" id="konten" class="form-control border-1 py-3 px-3" 
                              style="border-color: #C4E1E6; border-radius: 8px; min-height: 250px;"
                              rows="7" placeholder="Tulis konten edukasi yang informatif" required>{{ old('konten', $edukasi->konten) }}</textarea>
                    <div class="form-text text-muted">Gunakan format yang jelas dengan paragraf dan poin-poin penting</div>
                </div>

                {{-- Upload Gambar --}}
                <div class="mb-4">
                    <label for="gambar" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-image-fill me-2" style="color: #8DBCC7;"></i>
                        Gambar Pendukung
                    </label>
                    
                    <div class="file-upload-container border-1 rounded-4 p-4" 
                         style="border-color: #C4E1E6; border-style: dashed;">
                        @if($edukasi->gambar)
                        <div class="mb-3">
                            <p class="fw-semibold mb-2">Gambar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $edukasi->gambar) }}" class="img-fluid rounded-3 mb-2" style="max-height: 200px; border: 1px solid #dee2e6;">
                            <a href="{{ asset('storage/' . $edukasi->gambar) }}" target="_blank" class="btn btn-sm btn-outline-secondary me-2">
                                <i class="bi bi-eye-fill me-1"></i> Lihat Full
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('removePhoto').value = '1'">
                                <i class="bi bi-trash-fill me-1"></i> Hapus Gambar
                            </button>
                            <input type="hidden" name="removePhoto" id="removePhoto" value="0">
                        </div>
                        <hr class="my-4">
                        @endif
                        
                        <input type="file" name="gambar" id="gambar" class="d-none" accept="image/*">
                        <div id="filePreview" class="mb-3 d-none">
                            <p class="fw-semibold mb-2">Gambar Baru:</p>
                            <img id="previewImage" src="#" alt="Preview" class="img-fluid rounded-3 mb-2" style="max-height: 200px;">
                            <button type="button" id="changeImage" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-arrow-repeat me-1"></i> Ganti Gambar
                            </button>
                        </div>
                        <div id="uploadPrompt" class="text-center">
                            <i class="bi bi-cloud-arrow-up fs-1" style="color: #8DBCC7;"></i>
                            <p class="mb-2">Seret & lepas gambar atau <span class="text-primary">klik untuk memilih</span></p>
                            <small class="text-muted d-block">Format: JPG, PNG (Maks. 5MB)</small>
                            <button type="button" id="selectFileBtn" class="btn btn-sm mt-2 px-3" 
                                    style="background-color: #A4CCD9; color: #2c3e50;">
                                <i class="bi bi-folder2-open me-1"></i> Pilih File
                            </button>
                        </div>
                    </div>
                    <div class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti gambar</div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between mt-5 pt-3">
                    <a href="{{ route('admin.edukasi.index') }}" class="btn btn-hover px-4 py-2" 
                       style="background-color: #EBFFD8; color: #2c3e50; border-radius: 8px;">
                        <i class="bi bi-x-circle me-2"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-hover px-4 py-2" 
                            style="background-color: #8DBCC7; color: white; border-radius: 8px;" 
                            id="submitBtn">
                        <i class="bi bi-save-fill me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
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
    
    textarea.form-control {
        resize: vertical;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }
    
    @media (max-width: 767.98px) {
        .card-body {
            padding: 1.5rem !important;
        }
        
        .btn {
            padding: 0.5rem 1rem !important;
            font-size: 0.875rem;
        }
        
        .file-upload-container {
            padding: 1rem !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File upload preview
        const gambarInput = document.getElementById('gambar');
        const filePreview = document.getElementById('filePreview');
        const uploadPrompt = document.getElementById('uploadPrompt');
        const previewImage = document.getElementById('previewImage');
        const selectFileBtn = document.getElementById('selectFileBtn');
        const changeImage = document.getElementById('changeImage');
        
        selectFileBtn.addEventListener('click', () => gambarInput.click());
        changeImage?.addEventListener('click', () => gambarInput.click());
        
        gambarInput.addEventListener('change', function(e) {
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
        const form = document.getElementById('editForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat me-2"></i> Menyimpan...';
        });
    });
</script>
@endsection