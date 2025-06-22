@extends('components.admin-layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow p-4 border-0 rounded-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-info-circle-fill me-2"></i> Detail Informasi Bencana
        </h3>

        <div class="row g-4 align-items-start">
            {{-- Kolom Foto --}}
            <div class="col-md-4">
                @if ($laporan->media)
                    <img src="{{ asset('storage/' . $laporan->media) }}" alt="Foto Laporan"
                        class="img-fluid rounded-4 shadow-sm w-100" style="object-fit: cover;">
                @else
                    <div class="text-muted fst-italic">Tidak ada foto tersedia</div>
                @endif
            </div>

            {{-- Kolom Detail --}}
            <div class="col-md-8">
                <div class="mb-3">
                    <strong>Judul:</strong><br>
                    {{ $laporan->judul }}
                </div>

                <div class="mb-3">
                    <strong>Deskripsi:</strong><br>
                    {{ $laporan->deskripsi }}
                </div>

                <div class="mb-3">
                    <strong>Jenis Bencana:</strong><br>
                    {{ ucfirst($laporan->keterangan) }}
                </div>

                <div class="mb-3">
                    <strong>Lokasi:</strong><br>
                    {{ $laporan->lokasi }}
                </div>

                <div class="mb-3">
                    <strong>Tanggal Publish:</strong><br>
                    {{ \Carbon\Carbon::parse($laporan->tgl_publish)->translatedFormat('d M Y, H:i') }}
                </div>

                <div class="mb-3">
                    <strong>Pelapor:</strong><br>
                    {{ $laporan->user->akun->nama ?? 'Tidak diketahui' }}
                </div>

                <a href="{{ route('admin.informasi.index') }}" class="btn btn-outline-secondary rounded-pill px-4 mt-3">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
