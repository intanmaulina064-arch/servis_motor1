<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PembayaranService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PembayaranServiceApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => PembayaranService::with([
                'daftarService.pelanggan',
                'daftarService.kendaraan'
            ])->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|exists:daftar_service,id_servis_pelanggan',
            'jumlah_biaya_servis' => 'required|numeric|min:0',
            'jenis_pembayaran' => [
                'nullable',
                Rule::in(['Tunai', 'Non Tunai'])
            ],
            'keterangan' => 'nullable|string|max:1000',
        ]);

        $data = PembayaranService::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show(string $id)
    {
        $data = PembayaranService::with([
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
        $data = PembayaranService::findOrFail($id);

        $validated = $request->validate([
            'id_servis_pelanggan' => 'sometimes|required|exists:daftar_service,id_servis_pelanggan',
            'jumlah_biaya_servis' => 'sometimes|required|numeric|min:0',
            'jenis_pembayaran' => [
                'sometimes',
                'nullable',
                Rule::in(['Tunai', 'Non Tunai'])
            ],
            'keterangan' => 'sometimes|nullable|string|max:1000',
        ]);

        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil diperbarui',
            'data' => $data
        ]);
    }

    public function destroy(string $id)
    {
        $data = PembayaranService::findOrFail($id);
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dihapus'
        ]);
    }
}
