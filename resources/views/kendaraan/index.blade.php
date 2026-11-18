@extends('layouts.app')
@section('title', 'Data Kendaraan')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div><h3 class="page-heading mb-1">Data Kendaraan</h3><p class="text-muted mb-0">Kelola data kendaraan pelanggan.</p></div>
    <a href="{{ route('kendaraan.create') }}" class="btn btn-pink"><i class="bi bi-plus-lg me-1"></i>Tambah Kendaraan</a>
</div>
<div class="card"><div class="card-body"><div class="table-responsive">
<table class="table table-hover">
    <thead><tr><th>No</th><th>No. Plat</th><th>Pemilik</th><th>ID Pelanggan</th><th>Jenis</th><th>No. STNK</th><th>Tahun</th><th>Warna</th><th>Aksi</th></tr></thead>
    <tbody>
    @forelse($kendaraan as $item)
        <tr>
            <td>{{ $loop->iteration }}</td><td class="fw-semibold">{{ $item->no_plat_kendaraan }}</td>
            <td>{{ $item->nama_pemilik }}</td><td>{{ $item->id_pelanggan }}</td><td>{{ $item->jenis_kendaraan }}</td>
            <td>{{ $item->no_stnk }}</td><td>{{ $item->tahun_pembuatan }}</td><td>{{ $item->warna_kendaraan }}</td>
            <td class="text-nowrap">
                <a href="{{ route('kendaraan.edit', $item->no_plat_kendaraan) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('kendaraan.destroy', $item->no_plat_kendaraan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="9" class="text-center text-muted py-4">Belum ada data kendaraan.</td></tr>
    @endforelse
    </tbody>
</table></div></div></div>
@endsection
