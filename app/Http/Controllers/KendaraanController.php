<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanController extends Controller
{
    // Menampilkan seluruh data kendaraan
    public function index()
    {
        $kendaraan = Kendaraan::with('pelanggan')
            ->latest()
            ->get();

        return view('kendaraan.index', compact('kendaraan'));
    }

    // Menampilkan form tambah kendaraan
    public function create()
    {
        $pelanggan = Pelanggan::all();

        return view('kendaraan.create', compact('pelanggan'));
    }

    // Menyimpan data kendaraan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat_kendaraan' => 'required|string|max:15|unique:kendaraan,no_plat_kendaraan',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'jenis_kendaraan' => [
                'required',
                Rule::in(['Matic', 'Manual Transmisi'])
            ],
            'no_stnk' => 'required|string|max:30',
            'tahun_pembuatan' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:100',
            'warna_kendaraan' => 'required|string|max:50',
        ]);

        Kendaraan::create($validated);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    // Menampilkan form edit kendaraan
    public function edit(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $pelanggan = Pelanggan::all();

        return view(
            'kendaraan.edit',
            compact('kendaraan', 'pelanggan')
        );
    }

    // Memperbarui data kendaraan
    public function update(Request $request, string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'jenis_kendaraan' => [
                'required',
                Rule::in(['Matic', 'Manual Transmisi'])
            ],
            'no_stnk' => 'required|string|max:30',
            'tahun_pembuatan' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:100',
            'warna_kendaraan' => 'required|string|max:50',
        ]);

        $kendaraan->update($validated);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    // Menghapus data kendaraan
    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $kendaraan->delete();

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus.');
    }
}
