@extends('layouts.app')
@section('title', 'Daftar Service')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div><h3 class="page-heading mb-1">Daftar Service</h3><p class="text-muted mb-0">Pendaftaran kendaraan yang akan diservis.</p></div>
    <a href="{{ route('daftar-service.create') }}" class="btn btn-pink"><i class="bi bi-plus-lg me-1"></i>Tambah Daftar Service</a>
</div>
<div class="card"><div class="card-body"><div class="table-responsive">
<table class="table table-hover">
    <thead><tr><th>No</th><th>ID Service</th><th>Tanggal</th><th>Pelanggan</th><th>No. Plat</th><th>Keluhan</th><th>Aksi</th></tr></thead>
    <tbody>
    @forelse($daftarService as $item)
        <tr>
            <td>{{ $loop->iteration }}</td><td class="fw-semibold">{{ $item->id_servis_pelanggan }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_servis)->format('d-m-Y') }}</td>
            <td>{{ $item->pelanggan->nama_lengkap ?? '-' }}<div class="small text-muted">{{ $item->id_pelanggan }}</div></td>
            <td>{{ $item->no_plat_kendaraan }}</td><td>{{ $item->keluhan_kendaraan }}</td>
            <td class="text-nowrap">
                <a href="{{ route('daftar-service.edit', $item->id_servis_pelanggan) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('daftar-service.destroy', $item->id_servis_pelanggan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pendaftaran ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada daftar service.</td></tr>
    @endforelse
    </tbody>
</table></div></div></div>
@endsection
