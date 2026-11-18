<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DaftarServiceController extends Controller
{
    // Menampilkan daftar service
    public function index()
    {
        $daftarService = DaftarService::with([
            'pelanggan',
            'kendaraan'
        ])->latest()->get();

        return view(
            'daftar_service.index',
            compact('daftarService')
        );
    }

    // Form tambah daftar service
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $kendaraan = Kendaraan::with('pelanggan')->get();

        return view(
            'daftar_service.create',
            compact('pelanggan', 'kendaraan')
        );
    }

    // Menyimpan daftar service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|string|max:20|unique:daftar_service,id_servis_pelanggan',
            'no_plat_kendaraan' => 'required|exists:kendaraan,no_plat_kendaraan',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        // Memastikan kendaraan benar-benar milik pelanggan
        $kendaraan = Kendaraan::findOrFail(
            $validated['no_plat_kendaraan']
        );

        if ($kendaraan->id_pelanggan !== $validated['id_pelanggan']) {
            return back()
                ->withInput()
                ->withErrors([
                    'no_plat_kendaraan' =>
                    'Kendaraan bukan milik pelanggan yang dipilih.'
                ]);
        }

        DaftarService::create($validated);

        return redirect()
            ->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil ditambahkan.');
    }

    // Form edit daftar service
    public function edit(string $id)
    {
        $daftarService = DaftarService::findOrFail($id);

        $pelanggan = Pelanggan::all();

        $kendaraan = Kendaraan::with('pelanggan')->get();

        return view(
            'daftar_service.edit',
            compact('daftarService', 'pelanggan', 'kendaraan')
        );
    }

    // Memperbarui daftar service
    public function update(Request $request, string $id)
    {
        $daftarService = DaftarService::findOrFail($id);

        $validated = $request->validate([
            'no_plat_kendaraan' => 'required|exists:kendaraan,no_plat_kendaraan',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);

        $kendaraan = Kendaraan::findOrFail(
            $validated['no_plat_kendaraan']
        );

        if ($kendaraan->id_pelanggan !== $validated['id_pelanggan']) {
            return back()
                ->withInput()
                ->withErrors([
                    'no_plat_kendaraan' =>
                    'Kendaraan bukan milik pelanggan yang dipilih.'
                ]);
        }

        $daftarService->update($validated);

        return redirect()
            ->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil diperbarui.');
    }

    // Menghapus daftar service
    public function destroy(string $id)
    {
        $daftarService = DaftarService::findOrFail($id);

        $daftarService->delete();

        return redirect()
            ->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil dihapus.');
    }
}
