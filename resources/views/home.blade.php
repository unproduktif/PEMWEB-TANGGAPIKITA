@extends('components.layout')

@section('content')

<!-- Hero Section Carousel -->
<div id="heroCarousel" class="carousel slide mb-5 position-relative" data-bs-ride="carousel">
    <div class="carousel-inner rounded-4 shadow">
        <div class="carousel-item active">
            <img src="{{ asset('images/hero1.jpg') }}" class="d-block w-100" style="height: 420px; object-fit: cover;" alt="Hero Slide 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/hero2.jpg') }}" class="d-block w-100" style="height: 420px; object-fit: cover;" alt="Hero Slide 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/hero3.jpg') }}" class="d-block w-100" style="height: 420px; object-fit: cover;" alt="Hero Slide 3">
        </div>
    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

    <!-- Overlay Text -->
    <div class="position-absolute top-50 start-50 translate-middle text-center px-3 w-100">
        <h1 class="fw-bold display-4 text-white text-shadow">Tanggapikita</h1>
        <p class="fs-4 text-white text-shadow">
            Satu Aksi, Selamatkan Negeri: Laporkan, Edukasi, dan Berdonasi
        </p>
    </div>
</div>

@endsection
