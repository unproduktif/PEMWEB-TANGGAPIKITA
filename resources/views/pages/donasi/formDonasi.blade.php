@extends('components.layout')

@section('content')
<div class="container py-4 py-md-5">
    {{-- Hero Section --}}
    <div class="text-center mb-5 px-3">
        <h1 class="fw-bold display-5 display-md-4 mb-3" style="color: #222831;">
            <span class="d-block">Bantu Sesama,</span>
            <span class="text-gradient" style="background: linear-gradient(to right, #393E46, #00ADB5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Wujudkan Kepedulian Nyata</span>
        </h1>
        <p class="lead mb-4" style="color: #393E46;">
            <span class="fw-medium">Setiap Donasi</span> — Membawa Perubahan.
        </p>
        <div class="d-flex justify-content-center">
            <div style="width: 100px; height: 4px; background: linear-gradient(to right, #393E46, #00ADB5); border-radius: 2px;"></div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color: #EEEEEE;">
        <div class="card-body p-4 p-md-5">
            <h3 class="fw-bold mb-4" style="color: #222831;">
                <i class="bi bi-cash-coin me-2" style="color: #00ADB5;"></i>Form Donasi
            </h3>
            
            <form action="{{ route('donasi.midtrans') }}" method="POST" id="donasiForm">
                @csrf

                <input type="hidden" name="id_donasi" value="{{ $donasi->id_donasi }}">
                <input type="hidden" name="id_user" value="{{ auth()->user()->id_user ?? 1 }}">

                {{-- Judul Donasi --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold mb-3" style="color: #222831;">
                        <i class="bi bi-card-heading me-2" style="color: #00ADB5;"></i>
                        Judul Donasi
                    </label>
                    <input type="text" class="form-control border-1 py-3 px-3" 
                           style="border-color: #C4E1E6; border-radius: 8px; background-color: #EEEEEE;" 
                           value="{{ $donasi->judul }}" disabled>
                </div>

                {{-- Jumlah Donasi --}}
                <div class="mb-4">
                    <label for="jumlah" class="form-label fw-semibold mb-3" style="color: #222831;">
                        <i class="bi bi-currency-exchange me-2" style="color: #00ADB5;"></i>
                        Jumlah Donasi <span style="color: #393E46;">(Rp)</span>
                    </label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control border-1 py-3 px-3" 
                           style="border-color: #C4E1E6; border-radius: 8px;" 
                           required min="1000" step="1000" 
                           placeholder="Contoh: 10000">
                    <div class="form-text" style="color: #393E46;">Minimal donasi Rp1.000</div>
                </div>

                {{-- Pesan Opsional --}}
                <div class="mb-4">
                    <label for="pesan" class="form-label fw-semibold mb-3" style="color: #222831;">
                        <i class="bi bi-chat-square-text me-2" style="color: #00ADB5;"></i>
                        Pesan untuk Penerima <span style="color: #393E46;">(Opsional)</span>
                    </label>
                    <textarea name="pesan" id="pesan" rows="3" class="form-control border-1 py-3 px-3" 
                              style="border-color: #C4E1E6; border-radius: 8px;"
                              placeholder="Contoh: Semoga tetap kuat dan tabah."></textarea>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between mt-5 pt-3">
                    <a href="{{ route('donasi.index') }}" class="btn btn-hover px-4 py-2" 
                       style="background-color: #EEEEEE; color: #222831; border: 1px solid #393E46; border-radius: 8px;">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-hover px-4 py-2" 
                            style="background-color: #00ADB5; color: white; border-radius: 8px;" 
                            id="submitBtn">
                        <i class="bi bi-send-check-fill me-2"></i> Lanjut ke Pembayaran
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
    
    input:disabled {
        background-color: #EEEEEE !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form submission handling
        const form = document.getElementById('donasiForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat me-2"></i> Memproses...';
        });
    });
</script>
@endsection