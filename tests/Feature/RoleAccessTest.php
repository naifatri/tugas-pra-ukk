<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase; // Use in-memory database or reset database

    protected function setUp(): void
    {
        parent::setUp();
        // Seed roles
        \App\Models\Role::create(['nama_role' => 'admin']);
        \App\Models\Role::create(['nama_role' => 'petugas']);
        \App\Models\Role::create(['nama_role' => 'peminjam']);
    }

    public function test_admin_can_access_admin_dashboard()
    {
        $role = Role::where('nama_role', 'admin')->first();
        $user = User::factory()->create(['role_id' => $role->id, 'status_akun' => 'aktif']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_petugas_cannot_access_admin_dashboard()
    {
        $role = Role::where('nama_role', 'petugas')->first();
        $user = User::factory()->create(['role_id' => $role->id, 'status_akun' => 'aktif']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_peminjam_can_access_peminjam_dashboard()
    {
        $role = Role::where('nama_role', 'peminjam')->first();
        $user = User::factory()->create(['role_id' => $role->id, 'status_akun' => 'aktif']);

        $response = $this->actingAs($user)->get('/peminjam/dashboard');

        $response->assertStatus(200);
    }
}
