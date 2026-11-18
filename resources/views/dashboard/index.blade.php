@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h3 class="page-heading mb-1">Dashboard</h3>
    <p class="text-muted mb-0">Selamat datang di aplikasi Service Motor 1.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div><small class="text-muted">Total Pelanggan</small><h3 class="fw-bold mb-0">{{ $totalPelanggan ?? '—' }}</h3></div>
                <div class="stat-icon"><i class="bi bi-people"></i></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div><small class="text-muted">Total Kendaraan</small><h3 class="fw-bold mb-0">{{ $totalKendaraan ?? '—' }}</h3></div>
                <div class="stat-icon"><i class="bi bi-bicycle"></i></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div><small class="text-muted">Daftar Service</small><h3 class="fw-bold mb-0">{{ $totalDaftarService ?? '—' }}</h3></div>
                <div class="stat-icon"><i class="bi bi-clipboard-check"></i></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div><small class="text-muted">Pembayaran</small><h3 class="fw-bold mb-0">{{ $totalPembayaran ?? '—' }}</h3></div>
                <div class="stat-icon"><i class="bi bi-wallet2"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body p-4">
        <h5 class="fw-bold">Akses Menu</h5>
        <p class="text-muted">Pilih salah satu menu untuk mengelola data aplikasi.</p>
        <div class="row g-3">
            <div class="col-md-6 col-xl-4"><a href="{{ route('pelanggan.index') }}" class="btn btn-outline-danger w-100 py-3"><i class="bi bi-people me-2"></i>Data Pelanggan</a></div>
            <div class="col-md-6 col-xl-4"><a href="{{ route('kendaraan.index') }}" class="btn btn-outline-danger w-100 py-3"><i class="bi bi-bicycle me-2"></i>Data Kendaraan</a></div>
            <div class="col-md-6 col-xl-4"><a href="{{ route('daftar-service.index') }}" class="btn btn-outline-danger w-100 py-3"><i class="bi bi-clipboard-check me-2"></i>Daftar Service</a></div>
            <div class="col-md-6 col-xl-4"><a href="{{ route('data-service.index') }}" class="btn btn-outline-danger w-100 py-3"><i class="bi bi-tools me-2"></i>Data Service</a></div>
            <div class="col-md-6 col-xl-4"><a href="{{ route('pembayaran.index') }}" class="btn btn-outline-danger w-100 py-3"><i class="bi bi-wallet2 me-2"></i>Pembayaran Service</a></div>
        </div>
    </div>
</div>
@endsection
