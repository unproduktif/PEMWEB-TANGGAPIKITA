@extends('components.layout')

@section('content')
<div class="container mt-5 text-center">
    <div class="mb-5">
        <h3>Kebaikan Tak Pernah Terlambat <span class="text-primary">Mulailah Hari Ini</span></h3>
        <p class="text-muted fs-5"><strong class="text-dark">TanggapiKita</strong> Tanggap Hari Ini, Harapan Esok Hari.</p>
    </div>

        <!-- Form Pencarian -->
    <form action="{{ route('donasi.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari donasi..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
    </form>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($donasi as $donasi)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($donasi->laporan && $donasi->laporan->media)
                        <img src="{{ asset('storage/' . $donasi->laporan->media) }}" class="card-img-top" alt="{{ $donasi->judul }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $donasi->judul }}</h5>
                        <p class="card-text">{{ Str::limit($donasi->deskripsi, 100) }}</p>

                        <p class="card-text"><strong>Target:</strong> Rp{{ number_format($donasi->target) }}</p>
                        <p class="card-text"><strong>Terkumpul:</strong> Rp{{ number_format($donasi->total) }}</p>

                        @php
                            $persentase = ($donasi->target > 0) ? ($donasi->total / $donasi->target) * 100 : 0;
                        @endphp
                        <div class="progress mb-2" style="height: 20px;">
                            <div class="progress-bar" role="progressbar"
                                style="width: {{ $persentase }}%;"
                                aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100">
                                {{ number_format($persentase, 0) }}%
                            </div>
                        </div>

                        <a href="{{ route('donasi.index', ['id_donasi' => $donasi->id_donasi]) }}" class="btn btn-primary">Detail</a>
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