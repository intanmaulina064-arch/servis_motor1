@extends('layouts.app')
@section('title', 'Pembayaran Service')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div><h3 class="page-heading mb-1">Pembayaran Service</h3><p class="text-muted mb-0">Kelola transaksi pembayaran service.</p></div>
    <a href="{{ route('pembayaran.create') }}" class="btn btn-pink"><i class="bi bi-plus-lg me-1"></i>Tambah Pembayaran</a>
</div>
<div class="card"><div class="card-body"><div class="table-responsive">
<table class="table table-hover">
    <thead><tr><th>No</th><th>ID Pembayaran</th><th>ID Service</th><th>Pelanggan</th><th>Biaya</th><th>Jenis Pembayaran</th><th>Keterangan</th><th>Aksi</th></tr></thead>
    <tbody>
    @forelse($pembayaran as $item)
        <tr>
            <td>{{ $loop->iteration }}</td><td>{{ $item->id_pembayaran }}</td>
            <td>{{ $item->id_servis_pelanggan }}</td>
            <td>{{ $item->daftarService->pelanggan->nama_lengkap ?? '-' }}</td>
            <td>Rp {{ number_format((float) $item->jumlah_biaya_servis, 0, ',', '.') }}</td>
            <td>
                @if($item->jenis_pembayaran)
                    <span class="badge text-bg-light border">{{ $item->jenis_pembayaran }}</span>
                @else
                    <span class="text-muted">Belum dipilih</span>
                @endif
            </td>
            <td>{{ $item->keterangan ?: '-' }}</td>
            <td class="text-nowrap">
                <a href="{{ route('pembayaran.edit', $item->id_pembayaran) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('pembayaran.destroy', $item->id_pembayaran) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data pembayaran.</td></tr>
    @endforelse
    </tbody>
</table></div></div></div>
@endsection
