@extends('layouts.app')
@section('title', 'Edit Kendaraan')
@section('content')
<div class="mb-4"><h3 class="page-heading mb-1">Edit Kendaraan</h3><p class="text-muted mb-0">Perbarui informasi kendaraan.</p></div>
<div class="card"><div class="card-body p-4">
    <form action="{{ route('kendaraan.update', $kendaraan->no_plat_kendaraan) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nomor Plat Kendaraan</label>
        <input name="no_plat_kendaraan" class="form-control" value="{{ old('no_plat_kendaraan', $kendaraan->no_plat_kendaraan ?? '') }}" maxlength="15" placeholder="Contoh: BL 1234 AB" required @if(isset($kendaraan)) readonly @endif>
        @if(isset($kendaraan))<div class="form-text">Nomor plat sebagai primary key tidak diubah.</div>@endif
    </div>
    <div class="col-md-6">
        <label class="form-label">Nama Pemilik</label>
        <input name="nama_pemilik" id="nama_pemilik" class="form-control" value="{{ old('nama_pemilik', $kendaraan->nama_pemilik ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Pelanggan</label>
        <select name="id_pelanggan" class="form-select" required>
            <option value="">-- Pilih Pelanggan --</option>
            @foreach($pelanggan as $p)
                <option value="{{ $p->id_pelanggan }}" data-nama="{{ $p->nama_lengkap }}" @selected(old('id_pelanggan', $kendaraan->id_pelanggan ?? '') == $p->id_pelanggan)>
                    {{ $p->id_pelanggan }} - {{ $p->nama_lengkap }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label d-block">Jenis Kendaraan</label>
        @foreach(['Matic', 'Manual Transmisi'] as $jenis)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kendaraan" id="jenis_{{ $loop->index }}" value="{{ $jenis }}" @checked(old('jenis_kendaraan', $kendaraan->jenis_kendaraan ?? '') == $jenis) required>
                <label class="form-check-label" for="jenis_{{ $loop->index }}">{{ $jenis }}</label>
            </div>
        @endforeach
    </div>
    <div class="col-md-6"><label class="form-label">Nomor STNK</label><input name="no_stnk" class="form-control" value="{{ old('no_stnk', $kendaraan->no_stnk ?? '') }}" maxlength="30" required></div>
    <div class="col-md-6"><label class="form-label">Tahun Pembuatan</label><input name="tahun_pembuatan" type="number" class="form-control" min="1900" max="{{ date('Y') }}" value="{{ old('tahun_pembuatan', $kendaraan->tahun_pembuatan ?? '') }}" required></div>
    <div class="col-md-6"><label class="form-label">Warna Kendaraan</label><input name="warna_kendaraan" class="form-control" value="{{ old('warna_kendaraan', $kendaraan->warna_kendaraan ?? '') }}" required></div>
</div>
        <div class="mt-4"><button class="btn btn-pink"><i class="bi bi-save me-1"></i>Perbarui</button> <a href="{{ route('kendaraan.index') }}" class="btn btn-light">Batal</a></div>
    </form>
</div></div>
@endsection
