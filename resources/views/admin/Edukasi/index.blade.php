@extends('components.admin-layout')

@section('content')
<div class="container mt-5 mb-4">

    <div class="mb-5 text-center">
        <h3 class="fw-bold display-6">
            <span class="text-dark">Tingkatkan Pengetahuan,</span><br>
            <span class="text-danger">Belajar Hari Ini</span>
        </h3>
        <p class="text-muted fs-5 mt-3">
            <strong class="text-dark">Tanggapikita</strong> — Edukasi untuk Semua.
        </p>
    </div>

    {{-- Tombol Tambah Edukasi --}}
    <div class="mb-4 text-end">
        @auth
            <a href="{{ route('admin.edukasi.create') }}" class="btn btn-primary">
                <i class="bi bi-journal-plus me-1"></i> Tambah Edukasi Baru
            </a>
        @else
            <a href="{{ route('admin.edukasi.create') }}" class="btn btn-primary" id="btn-tambah-edukasi">
                <i class="bi bi-journal-plus me-1"></i> Tambah Edukasi Baru
            </a>
        @endauth
    </div>

    {{-- List Edukasi --}}
    @auth
        @forelse ($edukasis as $edukasi)
        <div class="card shadow border-0 rounded-4 bg-light mb-4">
            <div class="row g-0">
                @if($edukasi->gambar)
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $edukasi->gambar) }}" class="img-fluid rounded-start h-100 w-100 object-fit-cover" alt="Gambar Edukasi">
                </div>
                @endif
                <div class="col-md-8">
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <div>
                            <h5 class="card-title fw-bold text-dark">{{ $edukasi->judul }}</h5>
                            <p class="text-muted mb-2">
                                <i class="bi bi-person-fill text-primary me-1"></i> {{ $edukasi->admin->nama ?? 'Admin' }}
                            </p>
                            <p class="mb-3">{{ Str::limit(strip_tags($edukasi->konten), 120) }}</p>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-3">
                            <a href="{{ route('admin.edukasi.show', $edukasi->id_edukasi) }}" class="btn btn-outline-primary px-4">
                                <i class="bi bi-eye-fill me-1"></i> Lihat Detail
                            </a>
                            <a href="{{ route('admin.edukasi.edit', $edukasi->id_edukasi) }}" class="btn btn-warning">
                                <i class="bi bi-pencil-fill me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.edukasi.destroy', $edukasi->id_edukasi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus edukasi ini?')">
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
                Belum ada konten edukasi yang tersedia.
            </div>
        @endforelse
    @else
        <div class="alert alert-warning text-center rounded-4" role="alert">
            Silakan login terlebih dahulu untuk melihat konten edukasi.
        </div>
    @endauth
</div>
@endsection
