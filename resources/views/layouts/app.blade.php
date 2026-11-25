
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') | Service Motor 1</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --pink: #e83e8c;
            --pink-dark: #bd236e;
            --pink-soft: #fce7f3;
            --page: #fff7fb;
            --ink: #493342;
        }

        body {
            background: var(--page);
            color: var(--ink);
            font-family: Arial, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #e83e8c, #b91c67);
            color: white;
            padding: 22px 15px;
        }

        .brand {
            font-weight: 800;
            font-size: 19px;
            color: white;
            text-decoration: none;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,.92);
            padding: 12px 14px;
            margin-bottom: 5px;
            border-radius: 10px;
            transition: .2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,.22);
            color: white;
        }

        .main-content {
            padding: 26px;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #f5d5e5;
            padding: 17px 25px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(190,35,110,.07);
        }

        .btn-pink {
            background: var(--pink);
            color: white;
            border-color: var(--pink);
        }

        .btn-pink:hover {
            background: var(--pink-dark);
            color: white;
        }

        .text-pink {
            color: var(--pink-dark);
        }

        .page-heading {
            font-weight: 800;
        }

        .table thead th {
            background: #fff2f8;
            color: #7b5369;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
        }

        .footer {
            color: #98798a;
            font-size: 13px;
            text-align: center;
            padding: 20px;
        }

        @media(max-width: 767px) {
            .sidebar {
                min-height: auto;
            }

            .main-content {
                padding: 16px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <aside class="col-md-3 col-lg-2 sidebar">

            <a href="{{ url('/') }}"
               class="brand d-flex align-items-center gap-2 mb-4">

                <i class="bi bi-wrench-adjustable-circle fs-2"></i>
                SERVICE MOTOR 1

            </a>

            <div class="small text-uppercase text-white-50 fw-bold mb-2">
                MENU UTAMA
            </div>

            <nav class="nav flex-column">

                <a href="{{ url('/') }}"
                   class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                    <i class="bi bi-grid me-2"></i>
                    Dashboard
                </a>

                <a href="{{ route('pelanggan.index') }}"
                   class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i>
                    Data Pelanggan
                </a>

                <a href="{{ route('kendaraan.index') }}"
                   class="nav-link {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}">
                    <i class="bi bi-bicycle me-2"></i>
                    Data Kendaraan
                </a>

                <a href="{{ route('daftar-service.index') }}"
                   class="nav-link {{ request()->routeIs('daftar-service.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check me-2"></i>
                    Daftar Service
                </a>

                <a href="{{ route('data-service.index') }}"
                   class="nav-link {{ request()->routeIs('data-service.*') ? 'active' : '' }}">
                    <i class="bi bi-tools me-2"></i>
                    Data Service
                </a>

                <a href="{{ route('pembayaran.index') }}"
                   class="nav-link {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
                    <i class="bi bi-wallet2 me-2"></i>
                    Pembayaran Service
                </a>

            </nav>

            <hr class="border-white border-opacity-25">

            <div class="small text-white-50">
                Aplikasi Pengelolaan Service Kendaraan
            </div>

        </aside>

        <!-- KONTEN UTAMA -->
        <main class="col-md-9 col-lg-10 px-0">

            <!-- HEADER -->
            <header class="topbar d-flex justify-content-between align-items-center">

                <div>
                    <div class="fw-bold">
                        @yield('title', 'Dashboard')
                    </div>

                    <small class="text-muted">
                        Sistem Informasi Service Motor
                    </small>
                </div>

                <span class="badge rounded-pill text-bg-light border text-pink">
                    <i class="bi bi-person-circle me-1"></i>
                    Administrator
                </span>

            </header>

            <!-- ISI HALAMAN -->
            <section class="main-content">

                <!-- NOTIFIKASI BERHASIL -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert">
                        </button>
                    </div>
                @endif

                <!-- NOTIFIKASI ERROR -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ session('error') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert">
                        </button>
                    </div>
                @endif

                <!-- VALIDASI -->
                @if($errors->any())
                    <div class="alert alert-danger">

                        <strong>Periksa kembali input kamu:</strong>

                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif

                <!-- KONTEN BLADE -->
                @yield('content')

            </section>

            <footer class="footer">
                © {{ date('Y') }} Service Motor 1.
                All Rights Reserved.
            </footer>

        </main>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>
