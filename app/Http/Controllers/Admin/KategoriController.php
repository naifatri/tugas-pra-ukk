<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = \App\Models\Kategori::paginate(10);
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        \App\Models\Kategori::create($request->all());

        \App\Models\LogAktivitas::storeLog('Tambah Kategori', 'Kategori', 'Menambahkan kategori baru: ' . $request->nama_kategori);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(string $id)
    {
        // Not used
    }

    public function edit(string $id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->update($request->all());

        \App\Models\LogAktivitas::storeLog('Edit Kategori', 'Kategori', 'Mengedit kategori: ' . $kategori->nama_kategori);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->delete();

        \App\Models\LogAktivitas::storeLog('Hapus Kategori', 'Kategori', 'Menghapus kategori: ' . $kategori->nama_kategori);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus');
    }
}
