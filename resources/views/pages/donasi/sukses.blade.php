@extends('components.layout')

@section('content')
@php
    $user = auth()->user();

    $donasi = \App\Models\User_donasi::where('id_user', $user->id_akun)
        ->latest()
        ->first();
    $metode = $userDonasiTerakhir->metode ?? 'bank_transfer';
    $labelMetode = match($metode) {
        'bank_transfer' => 'Transfer Bank',
        'qris' => 'QRIS',
        'e-wallet' => 'E-Wallet',
        'lainnya' => 'Lainnya',
        default => ucfirst($metode),
    };
@endphp
<div class="container py-4 py-md-5">

    {{-- Success Hero Section --}}
    <div class="text-center mb-5 px-3">
        <div class="success-icon-container mx-auto mb-4">
            <div class="icon-circle bg-success-soft">
                <i class="bi bi-check-circle-fill text-success"></i>
                <div class="circle-animation"></div>
                <div class="circle-animation delay-1"></div>
            </div>
        </div>
        <h1 class="fw-bold display-5 display-md-4 mb-3" style="color: #222831;">
            <span class="d-block">Donasi Anda Berhasil!</span>
            <span class="text-gradient" style="background: linear-gradient(to right, #393E46, #00ADB5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Terima Kasih Atas Kontribusi Anda</span>
        </h1>
        <p class="lead mb-4" style="color: #393E46;">
            Kami telah menerima donasi Anda dan akan segera memprosesnya.
        </p>
        <div class="d-flex justify-content-center">
            <div style="width: 100px; height: 4px; background: linear-gradient(to right, #393E46, #00ADB5); border-radius: 2px;"></div>
        </div>
    </div>

    {{-- Success Details Card --}}
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header border-0 py-3" style="background-color: #222831;">
                    <h5 class="mb-0 text-center text-white">Detail Donasi</h5>
                </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <span style="color: #393E46;">Status Donasi</span>
                            <span class="badge rounded-pill py-2 px-3" style="background-color: rgba(0, 173, 181, 0.1); color: #00ADB5;">
                                <i class="bi bi-check-circle-fill me-1"></i> Berhasil
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span style="color: #393E46;">Jumlah Donasi</span>
                            <span style="color: #222831; font-weight: 500;">Rp{{ number_format($donasi->jumlah ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span style="color: #393E46;">Tanggal</span>
                            <span style="color: #222831;">{{ now()->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span style="color: #393E46;">Metode Pembayaran</span>
                            <span style="color: #222831;">{{ $labelMetode }}</span>
                        </div>

                        <div class="alert alert-light mt-4 mb-0 border-0" style="background-color: #EEEEEE;">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-receipt me-3" style="font-size: 1.5rem; color: #00ADB5;"></i>
                                <div>
                                    <p class="mb-0 fw-medium" style="color: #222831;">
                                        Invoice telah dikirim ke email Anda
                                    </p>
                                    <small class="text-muted">Periksa folder spam jika tidak ditemukan</small>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    {{-- Next Steps --}}
    <div class="row justify-content-center mt-4">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3 text-center" style="color: #222831;">Apa Selanjutnya?</h5>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <div class="step-number" style="background-color: #00ADB5;">1</div>
                        </div>
                        <div>
                            <p class="mb-0 fw-medium" style="color: #222831;">Anda akan menerima email konfirmasi</p>
                            <small style="color: #393E46;">Berisi detail donasi dan bukti transaksi</small>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <div class="step-number" style="background-color: #00ADB5;">2</div>
                        </div>
                        <div>
                            <p class="mb-0 fw-medium" style="color: #222831;">Tim kami akan memproses donasi</p>
                            <small style="color: #393E46;">Dana akan disalurkan sesuai tujuan kampanye</small>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="step-number" style="background-color: #00ADB5;">3</div>
                        </div>
                        <div>
                            <p class="mb-0 fw-medium" style="color: #222831;">Anda bisa pantau perkembangan kampanye</p>
                            <small style="color: #393E46;">Lihat laporan transparansi di halaman kampanye</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="text-center mt-5">
        <a href="{{ route('donasi.index') }}" class="btn px-4 py-2 me-3" style="background-color: #00ADB5; color: white;">
            <i class="bi bi-heart-fill me-2"></i> Donasi Lagi
        </a>
        <a href="{{ route('home') }}" class="btn px-4 py-2" style="background-color: #393E46; color: white;">
            <i class="bi bi-house-door me-2"></i> Kembali ke Beranda
        </a>
    </div>
</div>

<style>
    .success-icon-container {
        width: 120px;
        height: 120px;
        position: relative;
    }
    
    .icon-circle {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .bg-success-soft {
        background-color: rgba(0, 173, 181, 0.1);
    }
    
    .text-success {
        color: #00ADB5 !important;
    }
    
    .icon-circle i {
        font-size: 3rem;
        z-index: 2;
    }
    
    .circle-animation {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 2px solid #00ADB5;
        animation: circle-expand 2s infinite;
        opacity: 0;
        z-index: 1;
    }
    
    .delay-1 {
        animation-delay: 1s;
    }
    
    @keyframes circle-expand {
        0% {
            transform: scale(0.8);
            opacity: 0.7;
        }
        100% {
            transform: scale(1.3);
            opacity: 0;
        }
    }
    
    .step-number {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.875rem;
    }
    
    .btn {
        border-radius: 8px;
        transition: all 0.3s ease;
        min-width: 180px;
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
    
    .badge {
        transition: all 0.3s ease;
    }
</style>
@endsection