@extends('components.layout')

@section('content')
<div class="container mt-4 mb-4">

    <div class="mb-5 text-center">
        <h3 class="fw-bold display-6">
            <span class="text-dark">Suarakan Kebenaran,</span><br>
            <span class="text-danger">Laporkan Hari Ini</span>
        </h3>
        <p class="text-muted fs-5 mt-3">
            <strong class="text-dark">TanggapiKita</strong> — Suara Anda, Tindakan Kami.
        </p>
    </div>

    {{-- Tombol Tambah Laporan --}}
    <div class="mb-4 text-end">
        <a href="{{ route('laporan.create') }}" class="btn btn-primary">
            <i class="bi bi-pencil-square me-1"></i> Buat Laporan Baru
        </a>
    </div>

    {{-- List Laporan --}}
    @forelse ($laporans as $laporan)
    <div class="card shadow border-0 rounded-4 bg-light mb-4">
        <div class="row g-0">
            @if($laporan->media)
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $laporan->media) }}" class="img-fluid rounded-start h-100 w-100 object-fit-cover" alt="Gambar Laporan">
            </div>
            @endif
            <div class="col-md-8">
                <div class="card-body d-flex flex-column justify-content-between h-100">
                    <div>
                        <h5 class="card-title fw-bold text-dark">{{ $laporan->judul }}</h5>
                        <p class="text-muted mb-2">
                            <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $laporan->lokasi }}
                        </p>
                        <p class="mb-3">{{ Str::limit($laporan->deskripsi, 120) }}</p>
                        <p class="mb-1">
                            <i class="bi bi-calendar-event-fill me-1 text-primary"></i> 
                            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($laporan->tgl_publish)->translatedFormat('d F Y') }}
                        </p>
                        <p class="mb-1">
                            <i class="bi bi-person-check-fill me-1 text-success"></i> 
                            <strong>Status:</strong> 
                            @if($laporan->status === 'verifikasi')
                                <span class="badge bg-success">verifikasi</span>
                            @else
                                <span class="badge bg-warning text-dark">pendding</span>
                            @endif
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <a href="{{ route('laporan.show', $laporan->id_laporan) }}" class="btn btn-outline-primary px-4">
                            <i class="bi bi-eye-fill me-1"></i> Lihat Detail
                        </a>
                        <a href="{{ route('laporan.index', $laporan->id_laporan) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-fill me-1"></i> Edit
                        </a>
                        <form action="{{ route('laporan.index', $laporan->id_laporan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash-fill me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
        <div class="alert alert-info text-center rounded-4" role="alert">
            Belum ada laporan yang Anda buat.
        </div>
    @endforelse

</div>
@endsection
