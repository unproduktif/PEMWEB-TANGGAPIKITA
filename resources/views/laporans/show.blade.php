@extends('components.layout')

@section('content')
<div class="container mt-4 mb-5">
    <div class="card shadow-sm border-0 rounded-4 p-4" style="background-color: #f4f1ee;">
        <h3 class="mb-3">{{ $laporan->judul }}</h3>

        <p class="mb-1">
            <strong><i class="bi bi-geo-alt-fill me-1 text-danger"></i> Lokasi:</strong> {{ $laporan->lokasi }}
        </p>
        <p class="mb-1">
            <strong><i class="bi bi-clock-fill me-1 text-primary"></i> Dipublikasikan:</strong>
            {{ \Carbon\Carbon::parse($laporan->tgl_publish)->translatedFormat('d M Y H:i') }}
        </p>
        <p class="mb-1">
            <strong><i class="bi bi-shield-check me-1 text-success"></i> Status:</strong>
            <span class="badge 
                @if($laporan->status == 'verifikasi') bg-success-subtle text-success-emphasis
                @else bg-secondary-subtle text-secondary-emphasis @endif">
                {{ ucfirst($laporan->status) }}
            </span>
        </p>
        <hr>
        <p><strong>Deskripsi:</strong></p>
        <p>{{ $laporan->deskripsi }}</p>
        <p><strong>Keterangan:</strong></p>
        <p>{{ $laporan->keterangan }}</p>

        @if ($laporan->media)
            <div class="mt-4">
                <img src="{{ asset('storage/' . $laporan->media) }}" class="img-fluid rounded" alt="Media">
            </div>
        @endif

        <a href="{{ route('laporans.index') }}" class="btn btn-secondary mt-4">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>
@endsection
