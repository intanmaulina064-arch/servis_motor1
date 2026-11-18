@extends('layouts.app')
@section('title', 'Edit Data Service')
@section('content')
<div class="mb-4"><h3 class="page-heading mb-1">Edit Data Service</h3><p class="text-muted mb-0">Perbarui detail pengerjaan service.</p></div>
<div class="card"><div class="card-body p-4">
    <form action="{{ route('data-service.update', $dataService->id_data_service) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">ID Service Pelanggan</label>
        <select name="id_servis_pelanggan" id="id_servis_pelanggan" class="form-select" required>
            <option value="">-- Pilih ID Service --</option>
            @foreach($daftarService as $ds)
                <option value="{{ $ds->id_servis_pelanggan }}" data-keluhan="{{ $ds->keluhan_kendaraan }}" data-pelanggan="{{ $ds->pelanggan->nama_lengkap ?? '' }}" data-plat="{{ $ds->no_plat_kendaraan }}" @selected(old('id_servis_pelanggan', $dataService->id_servis_pelanggan ?? '') == $ds->id_servis_pelanggan)>
                    {{ $ds->id_servis_pelanggan }} - {{ $ds->pelanggan->nama_lengkap ?? 'Pelanggan' }} ({{ $ds->no_plat_kendaraan }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6"><label class="form-label">Nama Pelanggan</label><input id="nama_pelanggan_service" class="form-control" readonly placeholder="Terisi otomatis"></div>
    <div class="col-md-6"><label class="form-label">Nomor Plat</label><input id="plat_service" class="form-control" readonly placeholder="Terisi otomatis"></div>
    <div class="col-12"><label class="form-label">Keluhan Kendaraan</label><textarea id="keluhan_kendaraan" class="form-control" rows="2" readonly placeholder="Keluhan muncul setelah ID service dipilih"></textarea></div>
    <div class="col-md-6"><label class="form-label">Estimasi Service</label><input name="estimasi_service" class="form-control" value="{{ old('estimasi_service', $dataService->estimasi_service ?? '') }}" placeholder="Contoh: 2 jam" required></div>
    <div class="col-md-6"><label class="form-label">Nama Mekanik</label><input name="nama_mekanik" class="form-control" value="{{ old('nama_mekanik', $dataService->nama_mekanik ?? '') }}" required></div>
    <div class="col-12"><label class="form-label">Sparepart Pengganti</label><textarea name="sparepart_pengganti" class="form-control" rows="2" placeholder="Kosongkan jika tidak ada">{{ old('sparepart_pengganti', $dataService->sparepart_pengganti ?? '') }}</textarea></div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('id_servis_pelanggan');
    const keluhan = document.getElementById('keluhan_kendaraan');
    const nama = document.getElementById('nama_pelanggan_service');
    const plat = document.getElementById('plat_service');

    function isiDetail() {
        const opt = select.options[select.selectedIndex];
        keluhan.value = opt ? (opt.dataset.keluhan || '') : '';
        nama.value = opt ? (opt.dataset.pelanggan || '') : '';
        plat.value = opt ? (opt.dataset.plat || '') : '';
    }
    select.addEventListener('change', isiDetail);
    isiDetail();
});
</script>
@endpush
        <div class="mt-4"><button class="btn btn-pink"><i class="bi bi-save me-1"></i>Perbarui</button> <a href="{{ route('data-service.index') }}" class="btn btn-light">Batal</a></div>
    </form>
</div></div>
@endsection
