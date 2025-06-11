@extends('components.layout')

@section('content')
<div class="container mt-5 text-center">
    <div class="mb-5">
        <h3><strong>Kebaikan Tak Pernah Terlambat – <span class="text-primary">Mulailah Hari Ini</span></strong></h3>
        <p class="text-muted fs-5"><strong class="text-dark">TanggapiKita</strong> – Tanggap Hari Ini, Harapan Esok Hari.</p>
    </div>
</div>

<!-- Form Pencarian -->
<form action="{{route('donasi')}}"></form>
@endsection