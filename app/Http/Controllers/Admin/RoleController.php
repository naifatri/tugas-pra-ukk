<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = \App\Models\Role::paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:255|unique:roles',
        ]);

        \App\Models\Role::create($request->all());

        \App\Models\LogAktivitas::storeLog('Tambah Role', 'Role', 'Menambahkan role baru: ' . $request->nama_role);

        return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan');
    }

    public function show($id)
    {
        // unused
    }

    public function edit($id)
    {
        $role = \App\Models\Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => 'required|string|max:255|unique:roles,nama_role,'.$id,
        ]);

        $role = \App\Models\Role::findOrFail($id);
        $role->update($request->all());

        \App\Models\LogAktivitas::storeLog('Edit Role', 'Role', 'Mengedit role: ' . $role->nama_role);

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui');
    }

    public function destroy($id)
    {
        $role = \App\Models\Role::findOrFail($id);
        $role->delete();

        \App\Models\LogAktivitas::storeLog('Hapus Role', 'Role', 'Menghapus role: ' . $role->nama_role);

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus');
    }
}
