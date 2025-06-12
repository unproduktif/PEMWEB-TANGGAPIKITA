@extends('components.layout')

@section('content')
<div class="container mt-4 mb-4">

    {{-- Form Search --}}
    <form method="GET" action="{{ route('laporan.index') }}" class="mb-4 d-flex justify-content-between flex-wrap gap-2">
        {{-- Search --}}
        <div class="input-group w-auto">
            <input type="text" name="search" class="form-control" placeholder="Cari informasi bencana..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>

        {{-- Filter Button Dropdown --}}
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


    <div class="row g-3">
        @forelse ($laporans as $laporan)
            <div class="col-md-12">
                <div class="card shadow border-start border-light-subtle rounded-4 bg-light
                    @if($laporan->status == 'verifikasi')
                    @else border-secondary @endif border-5">
                    <div class="card-body">
                        <h5 class="card-title">{{ $laporan->judul }}</h5>
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

                        <p class="mt-2">{{ $laporan->deskripsi }}</p>

                        <a href="{{ route('laporan.show', $laporan->id_laporan) }}" class="btn btn-outline-primary">
                            <i class="bi bi-eye-fill me-1"></i> Lihat Detail
                        </a>
                </div>
            </div>

        @empty
            <p class="text-center">Belum ada laporan bencana yang sesuai.</p>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleTanggalInput() {
        const filterWaktu = document.getElementById('filter_waktu').value;
        const tanggalWrapper = document.getElementById('tanggal-wrapper');

        if (filterWaktu === 'tanggal') {
            tanggalWrapper.style.display = 'block';
        } else {
            tanggalWrapper.style.display = 'none';
        }
    }

    // Panggil saat pertama kali halaman dimuat
    document.addEventListener('DOMContentLoaded', toggleTanggalInput);
</script>
@endpush
