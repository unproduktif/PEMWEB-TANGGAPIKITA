@extends('components.layout')

@section('content')
<div class="container mt-4 mb-4">

    <div class="mb-5 text-center">
        <h3 class="fw-bold display-6">
            <span class="text-dark">Kebaikan Tidak Pernah Terlambat,</span><br>
            <span class="text-primary">Mulailah Hari Ini</span>
        </h3>
        <p class="text-muted fs-5 mt-3">
            <strong class="text-dark">TanggapiKita</strong> — Jembatan Kecil Antara Niat Baikmu dan Harapan Mereka.
        </p>
    </div>

    {{-- Form Search & Filter --}}
    <form method="GET" action="{{ route('donasi.index') }}" class="mb-4 d-flex justify-content-between flex-wrap gap-2">
        <div class="input-group w-auto">
            <input type="text" name="search" class="form-control" placeholder="Cari donasi..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>

        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-funnel-fill me-1"></i> Filter
            </button>
            <div class="dropdown-menu p-3" style="min-width: 250px;">
                <div class="mb-2">
                    <label for="filter_waktu" class="form-label">Waktu</label>
                    <select name="filter_waktu" id="filter_waktu" class="form-select" onchange="toggleTanggalInput()">
                        <option value="">-- Pilih Waktu --</option>
                        <option value="hari" {{ request('filter_waktu') == 'hari' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="minggu" {{ request('filter_waktu') == 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="bulan" {{ request('filter_waktu') == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="tanggal" {{ request('filter_waktu') == 'tanggal' ? 'selected' : '' }}>Pilih Tanggal</option>
                    </select>
                </div>
                <div class="mb-3" id="tanggal-wrapper" style="display: none;">
                    <label for="tanggal" class="form-label">Tanggal Manual</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <button type="submit" class="btn btn-sm btn-primary w-100">Terapkan Filter</button>
            </div>
        </div>
    </form>

    {{-- List Donasi --}}
    @foreach ($donasi as $item)
    <div class="card shadow border-0 rounded-4 bg-light mb-4">
        <div class="row g-0">
            @if($item->laporan && $item->laporan->media)
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $item->laporan->media) }}" class="img-fluid rounded-start h-100 w-100 object-fit-cover" alt="{{ $item->judul }}">
            </div>
            @endif
            <div class="col-md-8">
                <div class="card-body d-flex flex-column justify-content-between h-100">
                    <div>
                        <h5 class="card-title fw-bold text-dark">{{ $item->judul }}</h5>
                        <p class="text-muted mb-3">{{ Str::limit($item->deskripsi, 150) }} <span class="text-primary fw-semibold">Yuk, bantu sekarang!</span></p>

                        <p class="mb-1">
                            <strong><i class="bi bi-bullseye me-1 text-primary"></i> Target:</strong>
                            Rp{{ number_format($item->target) }}
                        </p>
                        <p class="mb-1">
                            <strong><i class="bi bi-coin me-1 text-warning"></i> Terkumpul:</strong>
                            Rp{{ number_format($item->total) }}
                        </p>

                        @php
                            $persentase = ($item->target > 0) ? ($item->total / $item->target) * 100 : 0;
                        @endphp
                        <div class="progress mb-2" style="height: 18px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persentase }}%;" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100">
                                {{ number_format($persentase, 0) }}%
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <a href="{{ route('donasi.show', ['id_donasi' => $item->id_donasi]) }}" class="btn btn-outline-primary px-4">
                            <i class="bi bi-eye-fill me-1"></i> Lihat Detail
                        </a>
                        <a href="{{ route('donasi.form', $item->id_donasi) }}" class="btn btn-success">
                            <i class="bi bi-heart-fill me-1"></i> Donasi Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection

@push('scripts')
<script>
    function toggleTanggalInput() {
        const filterWaktu = document.getElementById('filter_waktu').value;
        const tanggalWrapper = document.getElementById('tanggal-wrapper');
        tanggalWrapper.style.display = (filterWaktu === 'tanggal') ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', toggleTanggalInput);
</script>
@endpush
