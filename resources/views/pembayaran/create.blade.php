@extends('layouts.app')
@section('title', 'Tambah Pembayaran')
@section('content')
<div class="mb-4"><h3 class="page-heading mb-1">Tambah Pembayaran</h3><p class="text-muted mb-0">Masukkan biaya dan metode pembayaran service.</p></div>
<div class="card"><div class="card-body p-4">
    <form action="{{ route('pembayaran.store') }}" method="POST">
        @csrf
        <div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">ID Service Pelanggan</label>
        <select name="id_servis_pelanggan" id="id_servis_pelanggan_bayar" class="form-select" required>
            <option value="">-- Pilih ID Service --</option>
            @foreach($daftarService as $ds)
                <option value="{{ $ds->id_servis_pelanggan }}" data-pelanggan="{{ $ds->pelanggan->nama_lengkap ?? '' }}" data-plat="{{ $ds->no_plat_kendaraan }}" data-keluhan="{{ $ds->keluhan_kendaraan }}" @selected(old('id_servis_pelanggan', $pembayaran->id_servis_pelanggan ?? '') == $ds->id_servis_pelanggan)>
                    {{ $ds->id_servis_pelanggan }} - {{ $ds->pelanggan->nama_lengkap ?? 'Pelanggan' }} ({{ $ds->no_plat_kendaraan }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6"><label class="form-label">Nama Pelanggan</label><input id="nama_pelanggan_bayar" class="form-control" readonly placeholder="Terisi otomatis"></div>
    <div class="col-md-6"><label class="form-label">Nomor Plat</label><input id="plat_bayar" class="form-control" readonly placeholder="Terisi otomatis"></div>
    <div class="col-md-6"><label class="form-label">Jumlah Biaya Service (Rp)</label><input type="number" name="jumlah_biaya_servis" class="form-control" min="0" step="0.01" value="{{ old('jumlah_biaya_servis', $pembayaran->jumlah_biaya_servis ?? '') }}" placeholder="Contoh: 150000" required></div>
    <div class="col-12">
        <label class="form-label d-block">Jenis Pembayaran <span class="text-muted fw-normal">(opsional)</span></label>
        @foreach(['Tunai' => 'Cash / Tunai', 'Non Tunai' => 'Non Tunai'] as $value => $label)
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="jenis_pembayaran" id="bayar_{{ $loop->index }}" value="{{ $value }}" @checked(old('jenis_pembayaran', $pembayaran->jenis_pembayaran ?? '') == $value)>
                <label class="form-check-label" for="bayar_{{ $loop->index }}">{{ $label }}</label>
            </div>
        @endforeach
    </div>
    <div class="col-12"><label class="form-label">Keterangan</label><textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Pembayaran lunas">{{ old('keterangan', $pembayaran->keterangan ?? '') }}</textarea></div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('id_servis_pelanggan_bayar');
    const nama = document.getElementById('nama_pelanggan_bayar');
    const plat = document.getElementById('plat_bayar');
    function isiInfo() {
        const opt = select.options[select.selectedIndex];
        nama.value = opt ? (opt.dataset.pelanggan || '') : '';
        plat.value = opt ? (opt.dataset.plat || '') : '';
    }
    select.addEventListener('change', isiInfo);
    isiInfo();
});
</script>
@endpush
        <div class="mt-4"><button class="btn btn-pink"><i class="bi bi-save me-1"></i>Simpan</button> <a href="{{ route('pembayaran.index') }}" class="btn btn-light">Batal</a></div>
    </form>
</div></div>
@endsection
