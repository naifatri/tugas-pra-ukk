<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
 {
        use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'tgl_pinjam',
        'tgl_harus_kembali',
        'tgl_kembali_real',
        'status_pinjam',
        'petugas_id',
        'denda',
        'keterangan_denda',
    ];

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    // Relasi: Peminjaman milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Peminjaman memiliki banyak Detail
    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }
}
