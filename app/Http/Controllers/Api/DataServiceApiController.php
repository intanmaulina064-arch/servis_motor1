<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataService;
use Illuminate\Http\Request;

class DataServiceApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => DataService::with([
                'daftarService.pelanggan',
                'daftarService.kendaraan'
            ])->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|exists:daftar_service,id_servis_pelanggan',
            'estimasi_service' => 'required|string|max:255',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'required|string|max:255',
        ]);

        $data = DataService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show(string $id)
    {
        $data = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = DataService::findOrFail($id);

        $validated = $request->validate([
            'id_servis_pelanggan' => 'sometimes|required|exists:daftar_service,id_servis_pelanggan',
            'estimasi_service' => 'sometimes|required|string|max:255',
            'nama_mekanik' => 'sometimes|required|string|max:255',
            'sparepart_pengganti' => 'sometimes|required|string|max:255',
        ]);

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil diperbarui',
            'data' => $data
        ]);
    }

    public function destroy(string $id)
    {
        $data = DataService::findOrFail($id);
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil dihapus'
        ]);
    }
}
