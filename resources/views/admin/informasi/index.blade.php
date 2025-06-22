@extends('components.admin-layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow p-4 border-0 rounded-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-megaphone-fill me-2"></i> Kelola Informasi Bencana
        </h3>

        @if($laporans->isEmpty())
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i> Belum ada informasi bencana yang terverifikasi.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Jenis</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporans as $index => $laporan)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $laporan->judul }}</td>
                                <td>{{ $laporan->user->akun->nama ?? 'Tidak diketahui' }}</td>
                                <td>{{ ucfirst($laporan->keterangan) }}</td>
                                <td>{{ $laporan->lokasi }}</td>
                                <td>{{ \Carbon\Carbon::parse($laporan->tgl_publish)->translatedFormat('d M Y, H:i') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        {{-- TOMBOL DETAIL --}}
                                        <a href="{{ route('admin.informasi.show', $laporan->id_laporan) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat detail informasi">
                                            <i class="bi bi-eye-fill me-1"></i> Detail
                                        </a>

                                        {{-- TOMBOL HAPUS --}}
                                        <form action="{{ route('admin.informasi.destroy', $laporan->id_laporan) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus informasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus informasi">
                                                <i class="bi bi-trash-fill me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
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
