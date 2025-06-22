<nav class="admin-sidebar">

    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/laporan') || Request::is('admin/laporan/*') ? 'active' : '' }}" href="/admin/laporan">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span>Kelola Laporan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/edukasi*') ? 'active' : '' }}" href="/admin/edukasi">
                    <i class="bi bi-journal-text"></i>
                    <span>Kelola Edukasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/informasi*') ? 'active' : '' }}" href="/admin/informasi">
                    <i class="bi bi-info-circle"></i>
                    <span>Kelola Informasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/laporandonasi') || Request::is('admin/laporandonasi/*') ? 'active' : '' }}" href="/admin/laporandonasi">
                    <i class="bi bi-cash-coin"></i>
                    <span>Alokasi Dana</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}" href="/admin/user">
                    <i class="bi bi-people"></i>
                    <span>Kelola Akun</span>
                </a>
            </li>
        </ul>
    </div>
    
    <div class="sidebar-footer px-4 py-3 text-center">
        <small class="text-muted">
            <i class="bi bi-shield-lock me-1"></i>
            Admin Panel v1.0
        </small>
    </div>
</nav>

<style>
    /* Sidebar Styles */
    .admin-sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        top: 60px;
        left: 0;
        background-color: white;
        box-shadow: 2px 0 15px rgba(0, 0, 0, 0.05);
        border-right: 1px solid #e9ecef;
        transition: all 0.3s ease;
        z-index: 1020;
        display: flex;
        flex-direction: column;
    }
    
    .sidebar-header {
        border-bottom: 1px solid #e9ecef;
    }
    
    .sidebar-title {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .sidebar-close {
        color: #6c757d;
        padding: 0.25rem;
        font-size: 1rem;
    }
    
    .sidebar-menu {
        flex: 1;
        overflow-y: auto;
        padding: 1rem 0;
    }
    
    .nav-item {
        margin-bottom: 0.25rem;
        padding: 0 0.75rem;
    }
    
    .nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1.25rem;
        color: #495057;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .nav-link i {
        font-size: 1.1rem;
        margin-right: 1rem;
        color: #6c757d;
        transition: all 0.3s ease;
    }
    
    .nav-link span {
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .nav-link:hover:not(.active) {
        background-color: #f8f9fa;
        color: #8DBCC7;
        transform: translateX(5px);
    }
    
    .nav-link:hover:not(.active) i {
        color: #8DBCC7;
        transform: scale(1.1);
    }
    
    .nav-link.active {
        background: #8DBCC7;
        color: white !important;
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
    }
    
    .nav-link.active i {
        color: white !important;
    }
    
    .sidebar-footer {
        border-top: 1px solid #e9ecef;
    }
    
    /* Responsive Sidebar */
    @media (max-width: 991.98px) {
        .admin-sidebar {
            transform: translateX(-100%);
        }
        
        .admin-sidebar.show {
            transform: translateX(0);
        }
    }
    
    /* Scrollbar Styling */
    .sidebar-menu::-webkit-scrollbar {
        width: 6px;
    }
    
    .sidebar-menu::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .sidebar-menu::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    
    .sidebar-menu::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>