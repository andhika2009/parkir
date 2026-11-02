<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Parkir' }}</title>

    <!-- Panggil CSS Bootstrap / Template Bawaan Projek -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="d-flex" id="wrapper">
        <!-- Sidebar Navigation -->
        <div class="bg-dark text-white p-3 min-vh-100" style="width: 250px;">
            <h4 class="text-center py-2 border-bottom fw-bold">Sistem Parkir</h4>
            <div class="nav flex-column nav-pills mt-3 gap-1">
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->is('admin/dashboard') ? 'active bg-primary' : '' }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard Admin</a>
                    <a href="{{ route('admin.area.index') }}" class="nav-link text-white {{ request()->is('admin/area*') ? 'active bg-primary' : '' }}"><i class="bi bi-geo-alt me-2"></i> Area Parkir</a>
                    <a href="{{ route('admin.kendaraan.index') }}" class="nav-link text-white {{ request()->is('admin/kendaraan*') ? 'active bg-primary' : '' }}"><i class="bi bi-car-front me-2"></i> Kendaraan</a>
                    <a href="{{ route('admin.log.index') }}" class="nav-link text-white {{ request()->is('admin/log*') ? 'active bg-primary' : '' }}"><i class="bi bi-journal-text me-2"></i> Log Aktivitas</a>
                @elseif(auth()->check() && auth()->user()->role == 'owner')
                    <a href="{{ route('owner.dashboard') }}" class="nav-link text-white {{ request()->is('owner/dashboard') ? 'active bg-primary' : '' }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard Owner</a>
                    <a href="{{ route('owner.laporan') }}" class="nav-link text-white {{ request()->is('owner/laporan*') ? 'active bg-primary' : '' }}"><i class="bi bi-file-earmark-text me-2"></i> Laporan</a>
                @elseif(auth()->check() && auth()->user()->role == 'petugas')
                <a href="{{ route('petugas.dashboard') }}" class="nav-link text-white {{ request()->is('petugas/dashboard') ? 'active bg-primary' : '' }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard Petugas</a>
                <a href="{{ route('petugas.transaksi.index') }}" class="nav-link text-white {{ request()->is('petugas/transaksi*') ? 'active bg-primary' : '' }}"><i class="bi bi-receipt me-2"></i> Transaksi Parkir</a>
                @endif
            </div>
        </div>

        <!-- Content Page Area -->
        <div class="flex-grow-1">
            <!-- Navbar Header -->
            <nav class="navbar navbar-expand navbar-light bg-white border-bottom px-4 d-flex justify-content-end shadow-sm">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary fs-6 px-3 py-2"><i class="bi bi-person-circle me-1"></i> {{ auth()->user()->nama ?? auth()->user()->user_name ?? 'User' }} ({{ ucfirst(auth()->user()->role ?? 'User') }})</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                    </form>
                </div>
            </nav>

            <!-- Main Content Yield -->
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Script JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>