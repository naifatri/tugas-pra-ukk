<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
        
        // Create an admin user for testing
        // User::create([
        //     'username' => 'admin',
        //     'password' => bcrypt('password'),
        //     'nama_lengkap' => 'Administrator',
        //     'kelas' => '-',
        //     'jurusan' => '-',
        //     'role_id' => 1, // Assumes admin is 1
        // ]);
    }
}
