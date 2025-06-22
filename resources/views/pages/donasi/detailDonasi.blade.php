@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <div class="row g-4">
            {{-- Gambar Donasi --}}
            <div class="col-md-6">
                @if($donasi->laporan && $donasi->laporan->media)
                    <img src="{{ asset('storage/' . $donasi->laporan->media) }}" class="img-fluid rounded-4 w-100 h-100 object-fit-cover" alt="{{ $donasi->judul }}">
                @else
                    <img src="https://via.placeholder.com/600x400?text=No+Image" class="img-fluid rounded-4 w-100 h-100 object-fit-cover" alt="No Image">
                @endif
            </div>

            {{-- Detail Donasi --}}
            <div class="col-md-6 d-flex flex-column justify-content-between">
                <div>
                    <h3 class="fw-bold text-dark">{{ $donasi->judul }}</h3>
                    <p class="text-muted mt-3">{{ $donasi->deskripsi }}</p>

                    <p class="mb-1 mt-4">
                        <strong><i class="bi bi-bullseye me-1 text-primary"></i> Target:</strong>
                        Rp{{ number_format($donasi->target) }}
                    </p>
                    <p class="mb-1">
                        <strong><i class="bi bi-coin me-1 text-warning"></i> Terkumpul:</strong>
                        Rp{{ number_format($donasi->total) }}
                    </p>

                    @php
                        $persentase = ($donasi->target > 0) ? ($donasi->total / $donasi->target) * 100 : 0;
                    @endphp

                    <div class="progress my-3" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persentase }}%;" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100">
                            {{ number_format($persentase, 0) }}%
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('donasi.form', $donasi->id_donasi) }}" class="btn btn-success">
                        <i class="bi bi-heart-fill me-1"></i> Donasi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
