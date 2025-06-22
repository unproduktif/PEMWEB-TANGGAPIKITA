@extends('components.layout')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-lg border-0 p-4" style="max-width: 420px; width: 100%; border-radius: 20px;">
        <div class="text-center mb-4">
            <i class="bi bi-shield-lock-fill text-primary" style="font-size: 2.5rem;"></i>
            <h4 class="fw-bold mt-2" style="color: #2c3e50;">Reset Password</h4>
            <p class="text-muted small">Silakan masukkan email dan password baru Anda.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <form action="{{ route('password.reset') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-envelope-fill text-primary"></i></span>
                    <input type="email" name="email" class="form-control" required placeholder="Masukkan email Anda">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock-fill text-primary"></i></span>
                    <input type="password" name="password" class="form-control" required placeholder="Password baru">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock-fill text-primary"></i></span>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm">
                <i class="bi bi-arrow-repeat me-1"></i> Reset Password
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none text-primary small">
                <i class="bi bi-arrow-left"></i> Kembali ke Login
            </a>
        </div>
    </div>
</div>
@endsection
