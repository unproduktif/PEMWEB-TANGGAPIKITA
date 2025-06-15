@extends('components.layout')

@section('content')
<div class="container mt-4 mb-5">
    <div class="card shadow-sm border-0 rounded-4 p-4" style="background-color: #f4f1ee;">
        <h3 class="mb-3">{{ $edukasi->judul }}</h3>

        <p class="mb-1">
            <strong><i class="bi bi-person-fill me-1 text-primary"></i> Oleh:</strong> {{ $edukasi->admin->nama ?? 'Admin' }}
        </p>
        <p class="mb-1">
            <strong><i class="bi bi-clock-fill me-1 text-success"></i> Dipublikasikan:</strong>
            {{ \Carbon\Carbon::parse($edukasi->created_at)->translatedFormat('d M Y H:i') }}
        </p>

        <hr>

        <p><strong>Konten:</strong></p>
        <div>{!! $edukasi->konten !!}</div>

        @if ($edukasi->gambar)
            <div class="mt-4">
                <img src="{{ asset('storage/' . $edukasi->gambar) }}" class="img-fluid rounded" alt="Gambar Edukasi">
            </div>
        @endif

        <a href="{{ route('admin.edukasi.index') }}" class="btn btn-secondary mt-4">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>
@endsection
