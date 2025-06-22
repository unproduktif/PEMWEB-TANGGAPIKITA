@extends('components.layout')

@section('content')
<div class="container mt-4 mb-5">
    <div class="card shadow border-0 rounded-4 overflow-hidden">
        <div class="row g-0">
            @if ($laporan->media)
            <div class="col-md-5">
                <img src="{{ asset('storage/' . $laporan->media) }}" class="img-fluid h-100 w-100 object-fit-cover" style="object-position: center;" alt="Media">
            </div>
            @endif

            <div class="col-md-7 p-4" style="background-color: #f8f9fa;">
                <h3 class="fw-bold text-dark mb-3">{{ $laporan->judul }}</h3>

                <p class="mb-2">
                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                    <strong>Lokasi:</strong> {{ $laporan->lokasi }}
                </p>

                <p class="mb-2">
                    <i class="bi bi-clock-fill text-primary me-1"></i>
                    <strong>Dipublikasikan:</strong>
                    {{ \Carbon\Carbon::parse($laporan->tgl_publish)->translatedFormat('d M Y, H:i') }}
                </p>

                <p class="mb-3">
                    <i class="bi bi-shield-check text-success me-1"></i>
                    <strong>Status:</strong>
                    <span class="badge 
                        @if($laporan->status == 'verifikasi') bg-success-subtle text-success
                        @else bg-warning-subtle text-dark @endif px-3 py-2 rounded-pill">
                        {{ ucfirst($laporan->status) }}
                    </span>
                </p>

                <hr>

                <div class="mb-3">
                    <p class="fw-semibold mb-1 text-dark">Deskripsi:</p>
                    <p class="text-muted">{{ $laporan->deskripsi }}</p>
                </div>

                <div>
                    <p class="fw-semibold mb-1 text-dark">Keterangan:</p>
                    <p class="text-muted">{{ $laporan->keterangan }}</p>
                </div>

                <a href="{{ url()->previous()}}" class="btn btn-secondary mt-4">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>

                @auth
                    @if ($laporan->status === 'verifikasi' && auth()->user()->id_akun === $laporan->id_user)
                        <a href="{{ route('donasi.createCampaign', $laporan->id_laporan) }}" class="btn btn-success mt-4 ms-2">
                            <i class="bi bi-bullseye me-1"></i> Buat Kampanye Donasi
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection