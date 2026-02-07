<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlatController extends Controller
{
    // Fitur: Tampilkan Data Alat
    public function index()
    {
        //
    }

    // Fitur: Tambah Alat
    public function store(Request $request)
    {
        // Validasi dan simpan alat (nama_alat, kategori_id, stok, dll)
    }

    // Fitur: Edit Alat
    public function update(Request $request, $id)
    {
        //
    }

    // Fitur: Hapus Alat
    public function destroy($id)
    {
        //
    }
}
