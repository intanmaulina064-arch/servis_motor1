<?php

namespace App\Http\Controllers;

use App\Models\PembayaranService;
use App\Models\DaftarService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PembayaranServiceController extends Controller
{
    // Menampilkan data pembayaran
    public function index()
    {
        $pembayaran = PembayaranService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan'
        ])->latest()->get();

        return view(
            'pembayaran.index',
            compact('pembayaran')
        );
    }

    // Form tambah pembayaran
    public function create()
    {
        $daftarService = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->get();

        return view(
            'pembayaran.create',
            compact('daftarService')
        );
    }

    // Menyimpan pembayaran
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|exists:daftar_service,id_servis_pelanggan',

            'jumlah_biaya_servis' => 'required|numeric|min:0|max:9999999999.99',

            'jenis_pembayaran' => [
                'nullable',
                Rule::in(['Tunai', 'Non Tunai'])
            ],

            'keterangan' => 'nullable|string',
        ]);

        PembayaranService::create($validated);

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    // Form edit pembayaran
    public function edit(string $id)
    {
        $pembayaran = PembayaranService::findOrFail($id);

        $daftarService = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->get();

        return view(
            'pembayaran.edit',
            compact('pembayaran', 'daftarService')
        );
    }

    // Memperbarui pembayaran
    public function update(Request $request, string $id)
    {
        $pembayaran = PembayaranService::findOrFail($id);

        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|exists:daftar_service,id_servis_pelanggan',

            'jumlah_biaya_servis' => 'required|numeric|min:0|max:9999999999.99',

            'jenis_pembayaran' => [
                'nullable',
                Rule::in(['Tunai', 'Non Tunai'])
            ],

            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update($validated);

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    // Menghapus pembayaran
    public function destroy(string $id)
    {
        $pembayaran = PembayaranService::findOrFail($id);

        $pembayaran->delete();

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
