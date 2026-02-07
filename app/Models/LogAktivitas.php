<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id',
        'aksi',
        'modul',
        'detail_teks',
    ];

    // Relasi: Log milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function storeLog($aksi, $modul, $detail = null)
    {
        self::create([
            'user_id' => auth()->id(),
            'aksi' => $aksi,
            'modul' => $modul,
            'detail_teks' => $detail
        ]);
    }
}
