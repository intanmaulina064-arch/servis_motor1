@extends('layouts.app')
@section('title', 'Data Service')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div><h3 class="page-heading mb-1">Data Service</h3><p class="text-muted mb-0">Kelola detail pengerjaan service.</p></div>
    <a href="{{ route('data-service.create') }}" class="btn btn-pink"><i class="bi bi-plus-lg me-1"></i>Tambah Data Service</a>
</div>
<div class="card"><div class="card-body"><div class="table-responsive">
<table class="table table-hover">
    <thead><tr><th>No</th><th>ID Data</th><th>ID Service</th><th>Keluhan</th><th>Estimasi</th><th>Mekanik</th><th>Sparepart</th><th>Aksi</th></tr></thead>
    <tbody>
    @forelse($dataService as $item)
        <tr>
            <td>{{ $loop->iteration }}</td><td>{{ $item->id_data_service }}</td>
            <td>{{ $item->id_servis_pelanggan }}</td>
            <td>{{ $item->daftarService->keluhan_kendaraan ?? '-' }}</td>
            <td>{{ $item->estimasi_service }}</td><td>{{ $item->nama_mekanik }}</td>
            <td>{{ $item->sparepart_pengganti ?: '-' }}</td>
            <td class="text-nowrap">
                <a href="{{ route('data-service.edit', $item->id_data_service) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('data-service.destroy', $item->id_data_service) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data service ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data pengerjaan service.</td></tr>
    @endforelse
    </tbody>
</table></div></div></div>
@endsection
