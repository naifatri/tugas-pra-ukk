<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alat = \App\Models\Alat::with('kategori')->get();
        return view('admin.alat.index', compact('alat'));
    }

    public function create()
    {
        $kategori = \App\Models\Kategori::all();
        return view('admin.alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kode_alat' => 'required|string|unique:alat,kode_alat',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak,hilang',
            'lokasi_penyimpanan' => 'required|string',
            'foto_alat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_alat')) {
            $data['foto_alat'] = $request->file('foto_alat')->store('alat', 'public');
        }

        \App\Models\Alat::create($data);

        \App\Models\LogAktivitas::storeLog('Tambah Alat', 'Alat', 'Menambahkan alat baru: ' . $request->nama_alat);

        return redirect()->route('alats.index')->with('success', 'Alat berhasil ditambahkan');
    }

    public function show(string $id)
    {
        // Not used
    }

    public function edit(string $id)
    {
        $alat = \App\Models\Alat::findOrFail($id);
        $kategori = \App\Models\Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kode_alat' => 'required|string|unique:alat,kode_alat,'.$id,
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak,hilang',
            'lokasi_penyimpanan' => 'required|string',
            'foto_alat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $alat = \App\Models\Alat::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto_alat')) {
            // Delete old photo if exists (optional)
            $data['foto_alat'] = $request->file('foto_alat')->store('alat', 'public');
        }

        $alat->update($data);

        \App\Models\LogAktivitas::storeLog('Edit Alat', 'Alat', 'Mengedit alat: ' . $alat->nama_alat);

        return redirect()->route('alats.index')->with('success', 'Alat berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $alat = \App\Models\Alat::findOrFail($id);
        $alat->delete();

        \App\Models\LogAktivitas::storeLog('Hapus Alat', 'Alat', 'Menghapus alat: ' . $alat->nama_alat);

        return redirect()->route('alats.index')->with('success', 'Alat berhasil dihapus');
    }
}
