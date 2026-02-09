<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'status_akun' => 'required|in:aktif,nonaktif',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        \App\Models\User::create($data);

        \App\Models\LogAktivitas::storeLog('Tambah User', 'User', 'Menambahkan user baru: ' . $request->username);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function show($id)
    {
        // unused
    }

    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $roles = \App\Models\Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'status_akun' => 'required|in:aktif,nonaktif',
        ]);

        $user = \App\Models\User::findOrFail($id);
        $data = $request->except('password');
        
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        \App\Models\LogAktivitas::storeLog('Edit User', 'User', 'Mengedit user: ' . $user->username);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        \App\Models\LogAktivitas::storeLog('Hapus User', 'User', 'Menghapus user: ' . $user->username);

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
