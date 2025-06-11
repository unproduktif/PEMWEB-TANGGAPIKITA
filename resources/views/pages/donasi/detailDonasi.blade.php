@extends('components.layout')

@section('content')
<div class="container mt-5 text-center">
    <div class="mb-5">
        <h3>Kebaikan Tak Pernah Terlambat <span class="text-primary">Mulailah Hari Ini</span></h3>
        <p class="text-muted fs-5"><strong class="text-dark">TanggapiKita</strong> Tanggap Hari Ini, Harapan Esok Hari.</p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($donasi as $donasi)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $donasi->judul }}</h5>
                        <p class="card-text">{{ Str::limit($donasi->deskripsi, 100) }}</p>
                        <p class="card-text"><strong>Target:</strong> Rp{{ number_format($donasi->target) }}</p>
                        <p class="card-text"><strong>Terkumpul:</strong> Rp{{ number_format($donasi->total) }}</p>
                        <a href="{{ route('donasi', ['id_donasi' => $donasi->id_donasi]) }}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada donasi yang tersedia.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection