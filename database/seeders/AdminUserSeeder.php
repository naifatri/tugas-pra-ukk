<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate([
            'nama_role' => 'admin',
        ]);

        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('password'),
                'nama_lengkap' => 'Administrator',
                'email' => 'admin@siput.local',
                'nomor_whatsapp' => '081234567890',
                'alamat' => 'Laboratorium SIPUT',
                'kelas' => '-',
                'jurusan' => '-',
                'status_akun' => 'aktif',
                'role_id' => $adminRole->id,
            ]
        );
    }
}
