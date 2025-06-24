@extends('components.admin-layout')

@section('content')
<div class="container mt-5 mb-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4"> 
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="bi bi-person-circle me-2"></i> Profil Saya
        </h3>

        {{-- Section Informasi Profil --}}
        <div class="row g-4 align-items-center mb-4 ">
            <div class="col-lg-3 text-center">
                @if(auth()->user()->foto)
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" 
                        class="rounded-circle shadow-sm border border-3 border-primary-subtle" width="130" height="130" style="object-fit: cover;" alt="Foto Profil">
                @else
                    <i class="bi bi-person-circle text-secondary" style="font-size: 110px;"></i>
                @endif
                <h5 class="mt-3 fw-semibold mb-0">{{ auth()->user()->nama }}</h5>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    @php
                        $profilData = [
                            ['icon' => 'person', 'label' => 'Nama', 'value' => auth()->user()->nama],
                            ['icon' => 'envelope', 'label' => 'Email', 'value' => auth()->user()->email],
                            ['icon' => 'telephone', 'label' => 'No HP', 'value' => auth()->user()->no_hp],
                            ['icon' => 'geo-alt', 'label' => 'Alamat', 'value' => auth()->user()->alamat],
                            ['icon' => 'building', 'label' => 'Jabatan', 'value' => auth()->user()->admin->jabatan ?? '-'],
                        ];
                    @endphp

                    @foreach ($profilData as $item)
                        <div class="col-sm-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-{{ $item['icon'] }} text-primary me-3 fs-5 mt-1"></i>
                                <div>
                                    <small class="text-muted">{{ $item['label'] }}</small>
                                    <div class="fw-medium">{{ $item['value'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="d-flex flex-wrap gap-3 mb-4">
            <button class="btn btn-outline-primary rounded-pill px-4" type="button" data-bs-toggle="collapse" data-bs-target="#formPerbarui">
                <i class="bi bi-pencil me-1"></i> Perbarui Data
            </button>
            <button class="btn btn-outline-danger rounded-pill px-4" type="button" data-bs-toggle="collapse" data-bs-target="#formPassword">
                <i class="bi bi-shield-lock me-1"></i> Ganti Password
            </button>
        </div>

        {{-- Collapse: Perbarui Data --}}
        <div class="collapse" id="formPerbarui">
            <div class="border rounded-4 p-4 mb-4 bg-light">
                <h5 class="text-primary fw-bold mb-3">
                    <i class="bi bi-pencil-square me-2"></i> Form Perbarui Data
                </h5>
                {{-- Form Update Data --}}
                <form action="{{ route('admin.profil.update') }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', auth()->user()->nama) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', auth()->user()->no_hp) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', auth()->user()->alamat) }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', auth()->user()->admin->jabatan ?? '') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success rounded-pill mt-3 px-4">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </form>

                {{-- Form Update Foto --}}
                <hr class="my-4">
                <form action="{{ route('admin.foto.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label">Foto Profil</label><br>
                        @if(auth()->user()->foto)
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto" width="100" class="rounded mb-2 d-block">
                        @endif
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-upload me-1"></i> Update Foto
                    </button>
                </form>
            </div>
        </div>

        {{-- Collapse: Ganti Password --}}
        <div class="collapse" id="formPassword">
            <div class="border rounded-4 p-4 bg-light">
                <h5 class="text-danger fw-bold mb-3"><i class="bi bi-shield-lock me-2"></i> Form Ganti Password</h5>
                <form action="{{ route('admin.password.update') }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_baru_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                        <i class="bi bi-key me-1"></i> Update Password
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
