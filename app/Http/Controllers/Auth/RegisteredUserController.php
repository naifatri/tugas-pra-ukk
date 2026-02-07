<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:255'],
            'jurusan' => ['required', 'string', 'max:255'],
        ]);

        // Cari role peminjam based on name 'peminjam'
        // Assuming seeded with 'peminjam'
        $rolepeminjam = \App\Models\Role::where('nama_role', 'peminjam')->first();

        // Fallback if not found (should be found if seeded)
        $roleId = $rolepeminjam ? $rolepeminjam->id : 3; 

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'role_id' => $roleId,
            'status_akun' => 'aktif',
        ]);

        event(new Registered($user));

        Auth::login($user);
        
        // Log Aktivitas
        \App\Models\LogAktivitas::create([
            'user_id' => $user->id,
            'aksi' => 'Register',
            'modul' => 'Auth',
            'detail_teks' => 'User ' . $user->username . ' berhasil mendaftar.',
        ]);

        return redirect(route('dashboard', absolute: false));
    }
}
