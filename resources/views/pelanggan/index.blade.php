@extends('layouts.app')
@section('title', 'Data Pelanggan')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div><h3 class="page-heading mb-1">Data Pelanggan</h3><p class="text-muted mb-0">Kelola informasi pelanggan.</p></div>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-pink"><i class="bi bi-plus-lg me-1"></i>Tambah Pelanggan</a>
</div>
<div class="card"><div class="card-body">
    <div class="table-responsive"><table class="table table-hover">
        <thead><tr><th>No</th><th>ID Pelanggan</th><th>Nama Lengkap</th><th>No. HP</th><th>Alamat</th><th>Pekerjaan</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($pelanggan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td><td>{{ $item->id_pelanggan }}</td><td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->no_hp }}</td><td>{{ $item->alamat_pelanggan }}</td><td>{{ $item->pekerjaan }}</td>
                <td class="text-nowrap">
                    <a href="{{ route('pelanggan.edit', $item->id_pelanggan) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('pelanggan.destroy', $item->id_pelanggan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data pelanggan.</td></tr>
        @endforelse
        </tbody>
    </table></div>
</div></div>
@endsection
