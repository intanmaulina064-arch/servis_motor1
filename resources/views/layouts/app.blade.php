<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Service Motor 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --pink: #e83e8c;
            --pink-dark: #bd236e;
            --pink-soft: #fce7f3;
            --page: #fff7fb;
            --ink: #493342;
        }
        body { background: var(--page); color: var(--ink); font-family: Arial, sans-serif; }
        .sidebar {
            min-height: 100vh; color: #fff;
            background: linear-gradient(180deg, #e83e8c, #b91c67);
        }
        .brand { font-weight: 800; letter-spacing: .2px; }
        .sidebar .nav-link {
            color: rgba(255,255,255,.92); border-radius: 10px;
            padding: .72rem .85rem; margin: .16rem 0;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,.2); color: #fff;
        }
        .main-content { padding: 26px; min-width: 0; }
        .topbar { background: #fff; border-bottom: 1px solid #f5d5e5; }
        .card { border: 0; border-radius: 16px; box-shadow: 0 5px 20px rgba(190,35,110,.07); }
        .card-header { background: #fff; border-bottom: 1px solid #f7e1ec; }
        .btn-pink { color: #fff; background: var(--pink); border-color: var(--pink); }
        .btn-pink:hover { color: #fff; background: var(--pink-dark); border-color: var(--pink-dark); }
        .text-pink { color: var(--pink-dark) !important; }
        .form-control:focus, .form-select:focus {
            border-color: #ee86b7; box-shadow: 0 0 0 .2rem rgba(232,62,140,.13);
        }
        .table thead th { white-space: nowrap; color: #7b5369; background: #fff2f8; }
        .table td { vertical-align: middle; }
        .page-heading { font-weight: 800; }
        .stat-icon {
            width: 46px; height: 46px; display: grid; place-items: center;
            border-radius: 13px; color: var(--pink-dark); background: var(--pink-soft);
            font-size: 1.35rem;
        }
        @media (max-width: 767.98px) {
            .sidebar { min-height: auto; }
            .main-content { padding: 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-3 col-lg-2 sidebar p-3">
            <a href="{{ url('/') }}" class="text-white text-decoration-none d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-wrench-adjustable-circle fs-3"></i>
                <span class="brand">SERVICE MOTOR 1</span>
            </a>
            <div class="text-uppercase small fw-bold text-white-50 mb-2">Menu utama</div>
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ Route::has('dashboard') ? route('dashboard') : url('/') }}">
                    <i class="bi bi-grid me-2"></i>Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">
                    <i class="bi bi-people me-2"></i>Data Pelanggan
                </a>
                <a class="nav-link {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}" href="{{ route('kendaraan.index') }}">
                    <i class="bi bi-bicycle me-2"></i>Data Kendaraan
                </a>
                <a class="nav-link {{ request()->routeIs('daftar-service.*') ? 'active' : '' }}" href="{{ route('daftar-service.index') }}">
                    <i class="bi bi-clipboard-check me-2"></i>Daftar Service
                </a>
                <a class="nav-link {{ request()->routeIs('data-service.*') ? 'active' : '' }}" href="{{ route('data-service.index') }}">
                    <i class="bi bi-tools me-2"></i>Data Service
                </a>
                <a class="nav-link {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}" href="{{ route('pembayaran.index') }}">
                    <i class="bi bi-wallet2 me-2"></i>Pembayaran Service
                </a>
            </nav>
            <hr class="border-white border-opacity-25">
            <div class="small text-white-50">Aplikasi pengelolaan service kendaraan</div>
        </aside>

        <main class="col-md-9 col-lg-10 px-0">
            <header class="topbar px-4 py-3 d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">@yield('title', 'Dashboard')</div>
                    <small class="text-muted">Sistem Informasi Service Motor</small>
                </div>
                <span class="badge rounded-pill text-bg-light border text-pink">
                    <i class="bi bi-person-circle me-1"></i>Administrator
                </span>
            </header>

            <section class="main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <div class="fw-bold mb-1">Periksa kembali input berikut:</div>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </section>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
