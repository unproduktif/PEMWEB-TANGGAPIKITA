@extends('components.layout')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-4 overflow-hidden shadow-lg" style="background-color: #EEEEEE;">
        <div class="row g-0">
            {{-- Gambar Donasi --}}
            <div class="col-lg-6">
                @if($donasi->laporan && $donasi->laporan->media)
                    <img src="{{ asset('storage/' . $donasi->laporan->media) }}" class="img-fluid w-100 h-100 object-fit-cover" style="min-height: 400px;" alt="{{ $donasi->judul }}">
                @else
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="min-height: 400px; background-color: #393E46;">
                        <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                    </div>
                @endif
            </div>

            {{-- Detail Donasi --}}
            <div class="col-lg-6">
                <div class="p-4 p-md-5 h-100 d-flex flex-column">
                    {{-- Header --}}
                    <div class="mb-4">
                        <h2 class="fw-bold mb-3" style="color: #222831;">{{ $donasi->judul }}</h2>
                        <div class="border-top border-3 mb-3" style="width: 60px; border-color: #00ADB5 !important;"></div>
                        <p class="mb-0" style="color: #393E46;">{{ $donasi->deskripsi }}</p>
                    </div>

                    {{-- Progress Section --}}
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: #222831;">
                                <i class="bi bi-bullseye me-2" style="color: #00ADB5;"></i>
                                <strong>Target:</strong> Rp{{ number_format($donasi->target) }}
                            </span>
                            <span style="color: #222831;">
                                <i class="bi bi-coin me-2" style="color: #00ADB5;"></i>
                                <strong>Terkumpul:</strong> Rp{{ number_format($donasi->total) }}
                            </span>
                        </div>

                        @php
                            $persentase = ($donasi->target > 0) ? ($donasi->total / $donasi->target) * 100 : 0;
                        @endphp

                        <div class="progress mb-4" style="height: 12px; background-color: #393E46;">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ $persentase }}%; background-color: #00ADB5;" 
                                 aria-valuenow="{{ $persentase }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-end mb-4" style="color: #00ADB5; font-weight: 600;">
                            {{ number_format($persentase, 0) }}% tercapai
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex flex-wrap gap-3 pt-3">
                            <a href="{{ session('donasi_previous_url', route('donasi.index')) }}" class="btn btn-outline-secondary px-4 rounded-pill flex-grow-1" style="border-color: #393E46; color: #393E46;">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                            @if($donasi->status === 'selesai')
                                <button class="btn px-4 rounded-pill flex-grow-1" style="background-color: #6c757d; color: #EEEEEE;" disabled>
                                    <i class="bi bi-check-circle-fill me-2"></i> Donasi Selesai
                                </button>
                            @else
                                <a href="{{ route('donasi.form', $donasi->id_donasi) }}" class="btn px-4 rounded-pill flex-grow-1" style="background-color: #00ADB5; color: #EEEEEE;">
                                    <i class="bi bi-heart-fill me-2"></i> Donasi Sekarang
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .progress-bar {
        transition: width 1s ease-in-out;
    }
    .btn {
        transition: all 0.3s ease;
    }
    .btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
</style>
@endsection