<?php

namespace App\Http\Controllers;

use App\Models\DataService;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DataServiceController extends Controller
{
    // Menampilkan data service
    public function index()
    {
        $dataService = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->latest()->get();

        return view(
            'data_service.index',
            compact('dataService')
        );
    }

    // Form tambah data service
    public function create()
    {
        $daftarService = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->get();

        return view(
            'data_service.create',
            compact('daftarService')
        );
    }

    // Menyimpan data service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|exists:daftar_service,id_servis_pelanggan',
            'estimasi_service' => 'required|string',
            'nama_mekanik' => 'required|string|max:100',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        DataService::create($validated);

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil ditambahkan.');
    }

    // Form edit data service
    public function edit(string $id)
    {
        $dataService = DataService::findOrFail($id);

        $daftarService = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->get();

        return view(
            'data_service.edit',
            compact('dataService', 'daftarService')
        );
    }

    // Memperbarui data service
    public function update(Request $request, string $id)
    {
        $dataService = DataService::findOrFail($id);

        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|exists:daftar_service,id_servis_pelanggan',
            'estimasi_service' => 'required|string',
            'nama_mekanik' => 'required|string|max:100',
            'sparepart_pengganti' => 'nullable|string',
        ]);

        $dataService->update($validated);

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil diperbarui.');
    }

    // Menghapus data service
    public function destroy(string $id)
    {
        $dataService = DataService::findOrFail($id);

        $dataService->delete();

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil dihapus.');
    }
}
