@extends('components.layout')

@section('content')
<div class="container py-4 py-md-5">

    {{-- Header Section --}}
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('laporan.show', $laporan->id_laporan) }}" class="btn btn-outline-secondary btn-hover me-3 rounded-circle" style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="fw-bold mb-0" style="color: #2c3e50;">
            <i class="bi bi-heart-fill me-2" style="color: #e74c3c;"></i>
            Buat Kampanye Donasi
        </h2>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('donasi.storeCampaign') }}" method="POST" id="campaignForm">
                @csrf
                <input type="hidden" name="id_user" value="{{ auth()->user()->id_user }}">
                <input type="hidden" name="id_laporan" value="{{ $laporan->id_laporan }}">

                {{-- Related Report Info --}}
                <div class="alert alert-light border mb-4" style="background-color: #EBFFD8; border-color: #8DBCC7;">
                    <div class="d-flex">
                        <i class="bi bi-info-circle-fill me-2" style="color: #8DBCC7;"></i>
                        <div>
                            <p class="fw-semibold mb-1">Membuat kampanye untuk laporan:</p>
                            <h5 class="mb-0">{{ $laporan->judul }}</h5>
                        </div>
                    </div>
                </div>

                {{-- Campaign Title --}}
                <div class="mb-4">
                    <label for="judul" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-card-heading me-2" style="color: #8DBCC7;"></i>
                        Judul Kampanye
                    </label>
                    <input type="text" name="judul" id="judul" class="form-control border-1 py-3 px-3" 
                           style="border-color: #C4E1E6; border-radius: 8px;" 
                           placeholder="Contoh: Bantu Korban Banjir di Desa Sukamaju" required>
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-text-paragraph me-2" style="color: #8DBCC7;"></i>
                        Deskripsi Kampanye
                    </label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control border-1 py-3 px-3" 
                              style="border-color: #C4E1E6; border-radius: 8px; min-height: 150px;"
                              rows="5" placeholder="Jelaskan tujuan dan rencana penggunaan dana donasi" required></textarea>
                </div>

                {{-- Target Amount --}}
                <div class="mb-4">
                    <label for="target" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                        <i class="bi bi-currency-exchange me-2" style="color: #8DBCC7;"></i>
                        Target Donasi
                    </label>
                    <div class="input-group">
                        <span class="input-group-text border-1" style="border-color: #C4E1E6; background-color: #f8f9fa;">Rp</span>
                        <input type="number" name="target" id="target" class="form-control border-1 py-3 px-3" 
                               style="border-color: #C4E1E6; border-radius: 0 8px 8px 0;" 
                               min="100000" placeholder="Minimum Rp100.000" required>
                    </div>
                    <div class="form-text text-muted">Masukkan target nominal yang ingin dicapai</div>
                </div>

                {{-- Date Range --}}
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="tgl_mulai" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                            <i class="bi bi-calendar-event me-2" style="color: #8DBCC7;"></i>
                            Tanggal Mulai
                        </label>
                        <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control border-1 py-3 px-3" 
                               style="border-color: #C4E1E6; border-radius: 8px;" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tgl_selesai" class="form-label fw-semibold mb-3" style="color: #2c3e50;">
                            <i class="bi bi-calendar-check me-2" style="color: #8DBCC7;"></i>
                            Tanggal Selesai
                        </label>
                        <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control border-1 py-3 px-3" 
                               style="border-color: #C4E1E6; border-radius: 8px;" required>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between mt-5 pt-3">
                    <a href="{{ route('laporan.show', $laporan->id_laporan) }}" class="btn btn-hover px-4 py-2" 
                       style="background-color: #EBFFD8; color: #2c3e50; border-radius: 8px;">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-hover px-4 py-2" 
                            style="background-color: #e74c3c; color: white; border-radius: 8px;" 
                            id="submitBtn">
                        <i class="bi bi-heart-fill me-2"></i> Luncurkan Kampanye
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
    
    .form-control:focus, .form-select:focus, .input-group-text {
        border-color: #8DBCC7 !important;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(141, 188, 199, 0.25);
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set minimum end date based on start date
        const startDate = document.getElementById('tgl_mulai');
        const endDate = document.getElementById('tgl_selesai');
        
        startDate.addEventListener('change', function() {
            endDate.min = this.value;
            if (endDate.value && endDate.value < this.value) {
                endDate.value = this.value;
            }
        });
        
        // Set default dates
        const today = new Date().toISOString().split('T')[0];
        startDate.min = today;
        startDate.value = today;
        
        const nextWeek = new Date();
        nextWeek.setDate(nextWeek.getDate() + 7);
        endDate.min = today;
        endDate.value = nextWeek.toISOString().split('T')[0];
        
        // Format currency input
        const targetInput = document.getElementById('target');
        targetInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
        
        // Form submission handling
        const form = document.getElementById('campaignForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat me-2"></i> Memproses...';
        });
    });
</script>
@endsection