<nav class="d-flex flex-column flex-shrink-0 p-3 bg-light border-end vh-100 position-fixed" style="width: 255px; top: 56px; overflow-y: auto;">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/laporan*') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">
                <i class="bi bi-exclamation-triangle me-2"></i> Kelola Laporan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/edukasi*') ? 'active' : '' }}" href="/admin/edukasi">
                <i class="bi bi-journal-text me-2"></i> Kelola Edukasi
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/informasi*') ? 'active' : '' }}" href="/admin/informasi">
                <i class="bi bi-info-circle me-2"></i> Kelola Informasi
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/laporandonasi*') ? 'active' : '' }}" href="{{route('admin.laporandonasi.index')}}">
                <i class="bi bi-info-circle me-2"></i> Alokasi Dana
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}" href="/admin/user">
                <i class="bi bi-people me-2"></i> Kelola Akun User
            </a>
        </li>
    </ul>
</nav>