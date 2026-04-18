<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::with('role')->paginate(10);
        $totalStats = [
            'totalUsers' => \App\Models\User::count(),
            'userAktif' => \App\Models\User::where('status_akun', 'aktif')->count(),
            'userNonaktif' => \App\Models\User::where('status_akun', '!=', 'aktif')->count(),
        ];
        return view('admin.user.index', compact('users', 'totalStats'));
    }

    public function create()
    {
        $roles = \App\Models\Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string|max:255|unique:users,username',
                'password' => 'required|string|min:8',
                'email' => 'nullable|email|max:255|unique:users,email',
                'nomor_whatsapp' => 'nullable|string|max:20',
                'nama_lengkap' => 'required|string|max:255',
                'kelas' => 'required|string|max:255',
                'jurusan' => 'required|string|max:255',
                'role_id' => 'required|integer|exists:roles,id',
                'status_akun' => 'required|in:aktif,nonaktif',
            ]);

            $validated['password'] = bcrypt($validated['password']);
            
            $user = \App\Models\User::create($validated);

            \App\Models\LogAktivitas::storeLog('Tambah User', 'User', 'Menambahkan user baru: ' . $request->username);

            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan user: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        // unused
    }

    public function edit($id)
    {
        try {
            $user = \App\Models\User::findOrFail($id);
            $roles = \App\Models\Role::all();
            return view('admin.user.edit', compact('user', 'roles'));
        } catch (\Exception $e) {
            Log::error('Error loading user for edit: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'User tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string|max:255|unique:users,username,'.$id,
                'email' => 'nullable|email|max:255|unique:users,email,'.$id,
                'nomor_whatsapp' => 'nullable|string|max:20',
                'nama_lengkap' => 'required|string|max:255',
                'kelas' => 'required|string|max:255',
                'jurusan' => 'required|string|max:255',
                'role_id' => 'required|integer|exists:roles,id',
                'status_akun' => 'required|in:aktif,nonaktif',
            ]);

            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'string|min:8'
                ]);
                $validated['password'] = bcrypt($request->password);
            }

            $user = \App\Models\User::findOrFail($id);
            $user->update($validated);

            \App\Models\LogAktivitas::storeLog('Edit User', 'User', 'Mengedit user: ' . $user->username);

            return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('User not found for update: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'User tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate user: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $user = \App\Models\User::findOrFail($id);
            $username = $user->username;
            $user->delete();

            \App\Models\LogAktivitas::storeLog('Hapus User', 'User', 'Menghapus user: ' . $username);

            return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('User not found for delete: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'User tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus user: ' . $e->getMessage());
        }
    }
}
