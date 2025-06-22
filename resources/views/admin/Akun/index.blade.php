@extends('components.admin-layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow border-0 rounded-4 p-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-people-fill me-2"></i> Kelola Akun Pengguna
        </h3>

        @if($users->isEmpty())
            <div class="alert alert-warning text-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Belum ada pengguna terdaftar.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $user->akun->nama ?? '-' }}</td>
                                <td>{{ $user->akun->email }}</td>
                                <td>{{ $user->akun->no_hp ?? '-' }}</td>
                                <td>{{ $user->akun->alamat ?? '-' }}</td>
                                <td class="text-center">
                                    {{-- Tambahkan aksi jika dibutuhkan --}}
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" disabled>
                                        <i class="bi bi-person-lines-fill me-1"></i> Lihat Detail
                                    </button>
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
