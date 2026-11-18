@extends('layouts.app')
@section('title', 'Tambah Pelanggan')
@section('content')
<div class="mb-4"><h3 class="page-heading mb-1">Tambah Pelanggan</h3><p class="text-muted mb-0">Masukkan informasi pelanggan baru.</p></div>
<div class="card"><div class="card-body p-4">
    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">ID Pelanggan</label><input name="id_pelanggan" class="form-control" value="{{ old('id_pelanggan') }}" placeholder="Contoh: PLG001" maxlength="20" required></div>
            <div class="col-md-6"><label class="form-label">Nama Lengkap</label><input name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" maxlength="100" required></div>
            <div class="col-md-6"><label class="form-label">No. HP</label><input name="no_hp" type="tel" class="form-control" value="{{ old('no_hp') }}" maxlength="20" required></div>
            <div class="col-md-6"><label class="form-label">Pekerjaan</label><input name="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}" maxlength="100" required></div>
            <div class="col-12"><label class="form-label">Alamat Pelanggan</label><textarea name="alamat_pelanggan" class="form-control" rows="3" required>{{ old('alamat_pelanggan') }}</textarea></div>
        </div>
        <div class="mt-4"><button class="btn btn-pink" type="submit"><i class="bi bi-save me-1"></i>Simpan</button> <a href="{{ route('pelanggan.index') }}" class="btn btn-light">Batal</a></div>
    </form>
</div></div>
@endsection


