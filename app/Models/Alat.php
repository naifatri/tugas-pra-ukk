<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alat extends Model
{
       use HasFactory;

    protected $table = 'alat';

    protected $fillable = [
        'nama_alat',
        'kode_alat',
        'kategori_id',
        'stok',
        'kondisi',
        'lokasi_penyimpanan',
        'foto_alat',
        'deskripsi',
    ];

    // Relasi: Alat milik satu Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi: Alat ada di banyak Detail Peminjaman
    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }
}
