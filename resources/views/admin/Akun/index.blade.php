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
            {{-- TAMPILAN UNTUK DESKTOP --}}
            <div class="d-none d-md-block table-responsive">
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
                            <td>{{ $user->akun->email ?? '-' }}</td>
                            <td>{{ $user->akun->no_hp ?? '-' }}</td>
                            <td>{{ $user->akun->alamat ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.akun.edit', $user->id_user) }}"
                                        class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                        onclick="hapusAkun({{ $user->id_user }})">
                                        <i class="bi bi-trash-fill me-1"></i> Hapus
                                    </button>
                                    <form id="hapus-form-{{ $user->id_user }}" action="{{ route('admin.akun.destroy', $user->id_user) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- TAMPILAN UNTUK MOBILE --}}
            <div class="d-block d-md-none">
                @foreach($users as $user)
                <div class="card shadow-sm mb-3 border-0 rounded-3">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-2">{{ $user->akun->nama ?? '-' }}</h5>
                        <p class="mb-1"><strong>Email:</strong> {{ $user->akun->email ?? '-' }}</p>
                        <p class="mb-1"><strong>No HP:</strong> {{ $user->akun->no_hp ?? '-' }}</p>
                        <p class="mb-3"><strong>Alamat:</strong> {{ $user->akun->alamat ?? '-' }}</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.akun.edit', $user->id_user) }}"
                                class="btn btn-sm btn-outline-warning flex-fill rounded-pill">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.akun.destroy', $user->id_user) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus akun ini?')" class="w-100">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger flex-fill rounded-pill w-100">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
