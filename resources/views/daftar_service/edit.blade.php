@extends('layouts.app')
@section('title', 'Edit Daftar Service')
@section('content')
<div class="mb-4"><h3 class="page-heading mb-1">Edit Daftar Service</h3><p class="text-muted mb-0">Perbarui informasi pendaftaran service.</p></div>
<div class="card"><div class="card-body p-4">
    <form action="{{ route('daftar-service.update', $daftarService->id_servis_pelanggan) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">ID Service Pelanggan</label>
        <input name="id_servis_pelanggan" class="form-control" value="{{ old('id_servis_pelanggan', $daftarService->id_servis_pelanggan ?? '') }}" placeholder="Contoh: SRV001" maxlength="20" required @if(isset($daftarService)) readonly @endif>
        @if(isset($daftarService))<div class="form-text">ID service tidak dapat diubah.</div>@endif
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Service</label>
        <input type="date" name="tanggal_servis" class="form-control" value="{{ old('tanggal_servis', isset($daftarService) ? \Carbon\Carbon::parse($daftarService->tanggal_servis)->format('Y-m-d') : date('Y-m-d')) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">ID Pelanggan</label>
        <select name="id_pelanggan" id="id_pelanggan" class="form-select" required>
            <option value="">-- Pilih Pelanggan --</option>
            @foreach($pelanggan as $p)
                <option value="{{ $p->id_pelanggan }}" data-nama="{{ $p->nama_lengkap }}" @selected(old('id_pelanggan', $daftarService->id_pelanggan ?? '') == $p->id_pelanggan)>
                    {{ $p->id_pelanggan }} - {{ $p->nama_lengkap }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Nama Pelanggan</label>
        <input type="text" id="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $daftarService->pelanggan->nama_lengkap ?? '') }}" readonly placeholder="Terisi otomatis">
    </div>
    <div class="col-md-6">
        <label class="form-label">Nomor Plat Kendaraan</label>
        <select name="no_plat_kendaraan" id="no_plat_kendaraan" class="form-select" required>
            <option value="">-- Pilih Nomor Plat --</option>
            @foreach($kendaraan as $k)
                <option value="{{ $k->no_plat_kendaraan }}" data-pelanggan="{{ $k->id_pelanggan }}" @selected(old('no_plat_kendaraan', $daftarService->no_plat_kendaraan ?? '') == $k->no_plat_kendaraan)>
                    {{ $k->no_plat_kendaraan }} - {{ $k->nama_pemilik }}
                </option>
            @endforeach
        </select>
        <div class="form-text">Pilihan kendaraan akan menyesuaikan pelanggan yang dipilih.</div>
    </div>
    <div class="col-12">
        <label class="form-label">Keluhan Kendaraan</label>
        <textarea name="keluhan_kendaraan" class="form-control" rows="3" required>{{ old('keluhan_kendaraan', $daftarService->keluhan_kendaraan ?? '') }}</textarea>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const pelanggan = document.getElementById('id_pelanggan');
    const nama = document.getElementById('nama_pelanggan');
    const kendaraan = document.getElementById('no_plat_kendaraan');
    const selectedPlat = @json(old('no_plat_kendaraan', $daftarService->no_plat_kendaraan ?? ''));

    function updatePelanggan() {
        const opt = pelanggan.options[pelanggan.selectedIndex];
        nama.value = opt ? (opt.dataset.nama || '') : '';
        const current = kendaraan.value;
        Array.from(kendaraan.options).forEach((option, index) => {
            if (index === 0) return;
            option.hidden = !pelanggan.value || option.dataset.pelanggan !== pelanggan.value;
        });
        if (current && kendaraan.selectedOptions[0]?.hidden) kendaraan.value = '';
    }

    pelanggan.addEventListener('change', updatePelanggan);
    updatePelanggan();
    if (selectedPlat) kendaraan.value = selectedPlat;
});
</script>
@endpush
        <div class="mt-4"><button class="btn btn-pink"><i class="bi bi-save me-1"></i>Perbarui</button> <a href="{{ route('daftar-service.index') }}" class="btn btn-light">Batal</a></div>
    </form>
</div></div>
@endsection
