@extends('components.layout')

@section('content')
<div class="container py-4 py-md-5">

    {{-- Status Section --}}
    <div class="text-center mb-5 px-3">
        <div class="mb-4">
            <div class="d-flex justify-content-center">
                <div class="pending-icon-container p-4 rounded-circle" style="background-color: rgba(0, 173, 181, 0.1);">
                    <i class="bi bi-hourglass-split" style="font-size: 2.5rem; color: #00ADB5;"></i>
                </div>
            </div>
        </div>
        <h1 class="fw-bold display-5 display-md-4 mb-3" style="color: #222831;">
            <span class="d-block">Permohonan Anda Sedang Diproses</span>
            <span class="text-gradient" style="background: linear-gradient(to right, #393E46, #00ADB5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Mohon Menunggu</span>
        </h1>
        <p class="lead mb-4" style="color: #393E46;">
            Kami sedang memverifikasi permohonan Anda. Anda akan menerima notifikasi begitu status berubah.
        </p>
        <div class="d-flex justify-content-center">
            <div style="width: 100px; height: 4px; background: linear-gradient(to right, #393E46, #00ADB5); border-radius: 2px;"></div>
        </div>
    </div>

    {{-- Status Card --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header border-0 py-3" style="background-color: #222831;">
                    <h5 class="mb-0 text-center text-white">Status Permohonan</h5>
                </div>
                <div class="card-body p-4">
                    {{-- Status Timeline --}}
                    <div class="timeline-container">
                        <div class="timeline-step completed">
                            <div class="timeline-dot" style="background-color: #00ADB5; border-color: #00ADB5;">
                                <i class="bi bi-check-lg text-white"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1 fw-semibold" style="color: #222831;">Permohonan Dikirim</h6>
                                <p class="small mb-0" style="color: #393E46;">Anda telah berhasil mengirim permohonan</p>
                            </div>
                        </div>
                        
                        <div class="timeline-step active">
                            <div class="timeline-dot" style="background-color: #00ADB5; border-color: #00ADB5;">
                                <div class="pulse-animation"></div>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1 fw-semibold" style="color: #222831;">Dalam Proses Verifikasi</h6>
                                <p class="small mb-0" style="color: #393E46;">Tim kami sedang memeriksa kelengkapan dokumen</p>
                            </div>
                        </div>
                        
                        <div class="timeline-step">
                            <div class="timeline-dot" style="background-color: #EEEEEE; border-color: #393E46;"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1 fw-semibold" style="color: #393E46;">Verifikasi Selesai</h6>
                                <p class="small mb-0" style="color: #393E46;">Anda akan menerima notifikasi hasil verifikasi</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Estimated Time --}}
                    <div class="alert alert-light mt-4 mb-0 border-0" style="background-color: #EEEEEE;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-history me-3" style="font-size: 1.5rem; color: #00ADB5;"></i>
                            <div>
                                <p class="mb-0 fw-medium" style="color: #222831;">
                                    Estimasi waktu proses: <span style="color: #00ADB5;">1-3 hari kerja</span>
                                </p>
                                <small class="text-muted">Tim kami akan berusaha memproses secepat mungkin</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="text-center mt-5">
        <a href="{{ route('dashboard') }}" class="btn px-4 py-2 me-2" style="background-color: #393E46; color: white;">
            <i class="bi bi-house-door me-2"></i> Kembali ke Beranda
        </a>
        <a href="{{ route('contact') }}" class="btn px-4 py-2" style="background-color: #00ADB5; color: white;">
            <i class="bi bi-headset me-2"></i> Hubungi Dukungan
        </a>
    </div>
</div>

<style>
    .pending-icon-container {
        width: 120px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px dashed #00ADB5;
    }
    
    .timeline-container {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline-container::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 15px;
        width: 2px;
        background-color: #EEEEEE;
    }
    
    .timeline-step {
        position: relative;
        padding-bottom: 25px;
    }
    
    .timeline-dot {
        position: absolute;
        left: -30px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid;
    }
    
    .timeline-content {
        padding-left: 20px;
    }
    
    .timeline-step.completed .timeline-content h6,
    .timeline-step.completed .timeline-content p {
        opacity: 0.7;
    }
    
    .timeline-step.active .timeline-dot {
        box-shadow: 0 0 0 8px rgba(0, 173, 181, 0.2);
    }
    
    .pulse-animation {
        width: 10px;
        height: 10px;
        background-color: white;
        border-radius: 50%;
        position: relative;
    }
    
    .pulse-animation::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #00ADB5;
        border-radius: 50%;
        animation: pulse 1.5s infinite;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        100% {
            transform: scale(3);
            opacity: 0;
        }
    }
    
    .btn {
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
</style>

@endsection