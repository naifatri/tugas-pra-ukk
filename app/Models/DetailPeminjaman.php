<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPeminjaman extends Model
{
       use HasFactory;

    // Nama tabel di DB jamak, perlu didefinisikan jika nama model singular
    protected $table = 'detail_peminjaman';

    protected $fillable = [
        'peminjaman_id',
        'alat_id',
        'jumlah',
        'jumlah_kembali',
        'kondisi_awal',
        'kondisi_kembali',
    ];

    // Relasi: Detail milik satu Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    // Relasi: Detail merujuk ke satu Alat
    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}
