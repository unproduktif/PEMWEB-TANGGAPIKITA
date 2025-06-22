@extends('components.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-gear-fill me-2"></i> Donasi yang Kamu Kelola
        </h3>

        @if($donasiKelola->isEmpty())
            <div class="alert alert-warning text-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Belum ada kampanye donasi yang kamu kelola.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Judul Donasi</th>
                            <th>Total Terkumpul</th>
                            <th>Target</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donasiKelola as $index => $donasi)
                            @php
                                $status = strtolower($donasi->status);
                                $badgeColor = match($status) {
                                    'berlangsung' => 'primary',
                                    'selesai' => 'secondary',
                                    'pending' => 'warning',
                                    default => 'dark'
                                };
                            @endphp
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $donasi->judul }}</td>
                                <td>
                                    <span class="fw-semibold text-success">
                                        Rp {{ number_format($donasi->total, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted">
                                        Rp {{ number_format($donasi->target, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $badgeColor }} text-uppercase">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="text-center text-nowrap">
                                    <div class="d-flex gap-2 justify-content-center flex-nowrap">
                                        <a href="{{ route('donasi.show', $donasi->id_donasi) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bi bi-eye-fill me-1"></i> Detail
                                        </a>
                                    {{-- Jika status sedang berlangsung, tampilkan Edit dan Selesaikan --}}
                                    @if($donasi->status === 'berlangsung')
                                        <a href="{{ route('donasi.edit', $donasi->id_donasi) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>

                                        <form action="{{ route('donasi.selesaikan', $donasi->id_donasi) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menyelesaikan kampanye ini?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                <i class="bi bi-check-circle me-1"></i> Selesaikan
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
