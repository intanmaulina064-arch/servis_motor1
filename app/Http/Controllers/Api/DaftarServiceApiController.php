<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DaftarServiceApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => DaftarService::with([
                'pelanggan',
                'kendaraan'
            ])->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|string|unique:daftar_service,id_servis_pelanggan',
            'no_plat_kendaraan' => 'required|exists:kendaraan,no_plat_kendaraan',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        $data = DaftarService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show(string $id)
    {
        $data = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = DaftarService::findOrFail($id);

        $validated = $request->validate([
            'no_plat_kendaraan' => 'sometimes|required|exists:kendaraan,no_plat_kendaraan',
            'id_pelanggan' => 'sometimes|required|exists:pelanggan,id_pelanggan',
            'keluhan_kendaraan' => 'sometimes|required|string',
            'tanggal_servis' => 'sometimes|required|date',
        ]);

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil diperbarui',
            'data' => $data
        ]);
    }

    public function destroy(string $id)
    {
        $data = DaftarService::findOrFail($id);
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil dihapus'
        ]);
    }
}
