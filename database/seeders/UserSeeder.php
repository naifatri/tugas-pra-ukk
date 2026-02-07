<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = \App\Models\Role::where('nama_role', 'admin')->first();
        $petugasRole = \App\Models\Role::where('nama_role', 'petugas')->first();
        $peminjamRole = \App\Models\Role::where('nama_role', 'peminjam')->first();

        if ($adminRole) {
            \App\Models\User::create([
                'username' => 'admin',
                'password' => bcrypt('password'), // password
                'nama_lengkap' => 'Administrator',
                'kelas' => '-',
                'jurusan' => '-',
                'role_id' => $adminRole->id,
            ]);
        }

        if ($petugasRole) {
            \App\Models\User::create([
                'username' => 'petugas',
                'password' => bcrypt('password'),
                'nama_lengkap' => 'Petugas Lab',
                'kelas' => '-',
                'jurusan' => '-',
                'role_id' => $petugasRole->id,
            ]);
        }

        if ($peminjamRole) {
            \App\Models\User::create([
                'username' => 'siswa',
                'password' => bcrypt('password'),
                'nama_lengkap' => 'Siswa Peminjam',
                'kelas' => 'XII RPL 1',
                'jurusan' => 'RPL',
                'role_id' => $peminjamRole->id,
            ]);
        }
    }
}
