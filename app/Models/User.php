<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
   use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'kelas',
        'jurusan',
        'status_akun',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi: User milik satu Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi: User memiliki banyak Peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // Relasi: User memiliki banyak Log Aktivitas
    public function log_aktivitas()
    {
        return $this->hasMany(LogAktivitas::class);
    }
}
