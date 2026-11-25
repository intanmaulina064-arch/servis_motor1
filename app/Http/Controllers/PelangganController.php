<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // Menampilkan semua data pelanggan
    public function index()
    {
        $pelanggan = Pelanggan::latest()->get();

        return view('pelanggan.index', compact('pelanggan'));
    }

    // Menampilkan form tambah pelanggan
    public function create()
    {
        return view('pelanggan.create');
    }

    // Menyimpan data pelanggan
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|string|max:20|unique:pelanggan,id_pelanggan',
            'nama_lengkap' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat_pelanggan' => 'required|string',
            'pekerjaan' => 'required|string|max:100'
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return view('pelanggan.edit', compact('pelanggan'));
    }

    // Memperbarui data pelanggan
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat_pelanggan' => 'required|string',
            'pekerjaan' => 'required|string|max:100'
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    // Menghapus data pelanggan
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
