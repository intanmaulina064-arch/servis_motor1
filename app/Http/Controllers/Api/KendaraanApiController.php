<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Kendaraan::with('pelanggan')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat_kendaraan' => 'required|string|unique:kendaraan,no_plat_kendaraan',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'jenis_kendaraan' => [
                'required',
                Rule::in(['Matic', 'Manual Transmisi'])
            ],
            'no_stnk' => 'required|string|max:50',
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'warna_kendaraan' => 'required|string|max:100',
        ]);

        $data = Kendaraan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show(string $id)
    {
        $data = Kendaraan::with('pelanggan')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = Kendaraan::findOrFail($id);

        $validated = $request->validate([
            'id_pelanggan' => 'sometimes|required|exists:pelanggan,id_pelanggan',
            'jenis_kendaraan' => [
                'sometimes',
                'required',
                Rule::in(['Matic', 'Manual Transmisi'])
            ],
            'no_stnk' => 'sometimes|required|string|max:50',
            'tahun_pembuatan' => 'sometimes|required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'sometimes|required|string|max:255',
            'warna_kendaraan' => 'sometimes|required|string|max:100',
        ]);

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil diperbarui',
            'data' => $data
        ]);
    }

    public function destroy(string $id)
    {
        $data = Kendaraan::findOrFail($id);
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan berhasil dihapus'
        ]);
    }
}
