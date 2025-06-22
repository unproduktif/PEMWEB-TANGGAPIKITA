@extends('components.layout')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center background-color: #1e90ff">
    <div class="row shadow-lg rounded-5 overflow-hidden p-0" style="max-width: 960px; width: 100%; background-color: #ffffff;">
        
        {{-- Kolom Gambar --}}
        <div class="col-md-6 d-none d-md-block p-0">
            <img src="{{ asset('images/figurelogin.jpg') }}" 
                 alt="Login Illustration" 
                 class="img-fluid w-100 h-100 object-fit-cover"
                 style="transition: transform 0.3s ease-in-out;">
        </div>

        {{-- Kolom Form --}}
        <div class="col-md-6 p-5 d-flex flex-column justify-content-center">
            <h2 class="text-center text-primary fw-bold mb-3">Selamat Datang di Portal Donasi</h2>
            <p class="text-muted text-center mb-4">
                Bergabunglah bersama kami untuk membantu sesama dan berbagi kebaikan.
            </p>

            <form action="{{ route('login') }}" method="POST" class="needs-validation" novalidate>
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-pill shadow-sm" required placeholder="Masukkan email Anda">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control rounded-pill shadow-sm" required placeholder="Masukkan password">
                    <div class="text-end mt-1">
                        <a href="{{ route('password.request') }}" class="text-decoration-none text-primary small">Lupa Password?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm" style="background-color: #1e90ff; color: white;">Login</button>

                <div class="mt-4 text-center">
                    <small>Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none text-primary">Daftar di sini</a></small>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
