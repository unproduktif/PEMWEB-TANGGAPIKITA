@extends('components.admin-layout')

@section('content')
<div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all">
    {{-- Card Header --}}
    <div class="card-header bg-white py-3 border-0">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="fw-bold mb-0" style="color: #2c3e50;">
                <i class="bi bi-people-fill me-2" style="color: #8DBCC7;"></i>
                Daftar Akun
            </h3>
            
            {{-- Add User Button --}}
            <a href="{{ route('admin.akun.create') }}" class="btn btn-primary" style="background-color: #8DBCC7; border-color: #8DBCC7;">
                <i class="bi bi-plus-circle-fill me-1"></i> Tambah Pengguna
            </a>
        </div>
    </div>

    {{-- Search and Filter Section --}}
    <div class="card-body border-bottom">
        <form action="{{ route('admin.akun.index') }}" method="GET">
            <div class="row g-3">
                {{-- Search Input --}}
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search" style="color: #8DBCC7;"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" name="search" 
                               placeholder="Cari berdasarkan nama atau email..." 
                               value="{{ request('search') }}">
                    </div>
                </div>

                {{-- Role Filter --}}
                <div class="col-md-3">
                    <select class="form-select" name="role">
                        <option value="">Semua Peran</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Pengguna</option>
                    </select>
                </div>

                {{-- Action Buttons --}}
                <div class="col-md-3 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary" style="background-color: #8DBCC7; border-color: #8DBCC7;">
                        <i class="bi bi-funnel-fill me-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.akun.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Card Body --}}
    <div class="card-body p-0">
        @if($users->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-people-slash mb-3" style="font-size: 3rem; color: #C4E1E6;"></i>
                <h5 class="fw-bold mb-2" style="color: #2c3e50;">Belum Ada Pengguna Terdaftar</h5>
                <p class="text-muted mb-4">Tidak ada akun pengguna yang ditemukan</p>
                <a href="{{ route('admin.akun.create') }}" class="btn btn-primary" style="background-color: #8DBCC7; border-color: #8DBCC7;">
                    <i class="bi bi-plus-circle-fill me-1"></i> Tambah Pengguna Pertama
                </a>
            </div>
        @else
            {{-- Desktop View --}}
            <div class="d-none d-md-block">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #EBFFD8;">
                            <tr>
                                <th class="ps-4" style="width: 60px;">No</th>
                                <th style="min-width: 180px;">Nama</th>
                                <th style="min-width: 200px;">Email</th>
                                <th style="min-width: 120px;">No HP</th>
                                <th class="pe-4" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                                <tr class="border-top">
                                    <td class="ps-4 fw-bold" style="color: #8DBCC7;">{{ $loop->iteration }}</td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold" style="color: #2c3e50;">
                                            {{ $user->akun->nama ?? '-' }}
                                            @if($user->role === 'admin')
                                                <span class="badge ms-2" style="background-color: #8DBCC7; color: white;">Admin</span>
                                            @endif
                                        </h6>
                                    </td>
                                    <td>{{ $user->akun->email ?? '-' }}</td>
                                    <td>{{ $user->akun->no_hp ?? '-' }}</td>
                                    <td class="pe-4">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.akun.show', $user->id_user) }}" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #e3f2fd; color: #2c3e50; border-radius: 8px;">
                                                <i class="bi bi-eye-fill me-1"></i> Detail
                                            </a>
                                            <a href="{{ route('admin.akun.edit', $user->id_user) }}" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #fff8e1; color: #2c3e50; border-radius: 8px;">
                                                <i class="bi bi-pencil-fill me-1"></i> Edit
                                            </a>
                                            <form id="hapus-form-{{ $user->id_user }}" 
                                                  action="{{ route('admin.akun.destroy', $user->id_user) }}" 
                                                  method="POST" 
                                                  >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-hover px-3 py-2 d-flex align-items-center" style="background-color: #ffebee; color: #c62828; border-radius: 8px;">
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
            </div>

            {{-- Mobile View --}}
            <div class="d-block d-md-none">
                @foreach($users as $user)
                <div class="card shadow-sm mb-3 border-0 rounded-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title text-primary mb-0">
                                {{ $user->akun->nama ?? '-' }}
                                @if($user->role === 'admin')
                                    <span class="badge ms-2" style="background-color: #8DBCC7; color: white; font-size: 0.6rem;">Admin</span>
                                @endif
                            </h5>
                            <span class="badge rounded-pill py-1 px-2" style="background-color: #8DBCC7; color: white;">
                                #{{ $loop->iteration }}
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-envelope-fill me-2" style="color: #8DBCC7;"></i>
                                <span>{{ $user->akun->email ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-telephone-fill me-2" style="color: #8DBCC7;"></i>
                                <span>{{ $user->akun->no_hp ?? '-' }}</span>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="bi bi-geo-alt-fill me-2 mt-1" style="color: #8DBCC7;"></i>
                                <span>{{ $user->akun->alamat ?? '-' }}</span>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.akun.show', $user->id_user) }}"
                                class="btn btn-sm btn-hover flex-fill d-flex justify-content-center align-items-center"
                                style="background-color: #0D6EFD; color: white; border-radius: 8px;">
                                <i class="bi bi-info-circle-fill me-1"></i>
                                Detail
                            </a>
                            <a href="{{ route('admin.akun.edit', $user->id_user) }}"
                                class="btn btn-sm btn-hover flex-fill d-flex justify-content-center align-items-center"
                                style="background-color: #FFC107; color: white; border-radius: 8px;">
                                <i class="bi bi-pencil-square me-1"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.akun.destroy', $user->id_user) }}" 
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus akun ini?')" 
                                  class="flex-fill">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-hover w-100 d-flex justify-content-center align-items-center"
                                        style="background-color: #DC3545; color: white; border-radius: 8px;">
                                    <i class="bi bi-trash-fill me-1"></i>
                                    Hapus
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

<style>
    .transition-all {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .btn-hover {
        transition: all 0.3s ease;
    }
    
    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(140, 188, 199, 0.1) !important;
    }
    
    @media (max-width: 767.98px) {
        .card:hover {
            transform: none;
        }
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enable tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection