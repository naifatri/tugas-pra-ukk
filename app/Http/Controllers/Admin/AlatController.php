<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Alat::with('kategori');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_alat', 'like', "%$search%")
                  ->orWhere('kode_alat', 'like', "%$search%")
                  ->orWhere('lokasi_penyimpanan', 'like', "%$search%");
            });
        }

        // Filter Kategori
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter Kondisi
        if ($request->has('kondisi') && $request->kondisi != '') {
            $query->where('kondisi', $request->kondisi);
        }

        // Sorting
        $sortField = $request->get('sort', 'id');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortField, $sortOrder);

        // Dynamic Stats based on filters
        $statsQuery = clone $query;
        $totalStats = [
            'totalStok' => (clone $statsQuery)->sum('stok'),
            'baikCount' => (clone $statsQuery)->where('kondisi', 'baik')->count(),
            'rusakCount' => (clone $statsQuery)->where('kondisi', 'rusak')->count(),
        ];

        $alat = $query->paginate(10)->withQueryString();
        $kategori = \App\Models\Kategori::all();

        return view('admin.alat.index', compact('alat', 'totalStats', 'kategori'));
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
            'foto_alat' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ], [
            'foto_alat.image' => 'File harus berupa gambar.',
            'foto_alat.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'foto_alat.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_alat')) {
            $path = $request->file('foto_alat')->store('alat', 'public');
            $data['foto_alat'] = $path;
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
            'foto_alat' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ], [
            'foto_alat.image' => 'File harus berupa gambar.',
            'foto_alat.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'foto_alat.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $alat = \App\Models\Alat::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto_alat')) {
            // Delete old photo if it exists
            if ($alat->foto_alat && \Illuminate\Support\Facades\Storage::disk('public')->exists($alat->foto_alat)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($alat->foto_alat);
            }
            $path = $request->file('foto_alat')->store('alat', 'public');
            $data['foto_alat'] = $path;
        }

        $alat->update($data);

        \App\Models\LogAktivitas::storeLog('Edit Alat', 'Alat', 'Mengedit alat: ' . $alat->nama_alat);

        return redirect()->route('alats.index')->with('success', 'Alat berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $alat = \App\Models\Alat::findOrFail($id);
        
        // Delete photo if it exists
        if ($alat->foto_alat && \Illuminate\Support\Facades\Storage::disk('public')->exists($alat->foto_alat)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($alat->foto_alat);
        }

        $alat->delete();

        \App\Models\LogAktivitas::storeLog('Hapus Alat', 'Alat', 'Menghapus alat: ' . $alat->nama_alat);

        return redirect()->route('alats.index')->with('success', 'Alat berhasil dihapus');
    }
}
