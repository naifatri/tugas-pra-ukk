<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <img src="{{ asset('assets/siput.logo.png') }}" alt="Logo" class="w-56 h-auto">
            
        </div>
    </div>

    <nav class="mt-10">
        @php
            $role = Auth::user()->role->nama_role ?? '';
        @endphp

        <!-- Admin Links -->
        @if($role == 'admin')
            <a class="flex items-center mt-0 py-2 px-6 {{ request()->routeIs('dashboard.admin') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('dashboard.admin') }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('users.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('users.index') }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="mx-3">Users</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('roles.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('roles.index') }}">
               <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span class="mx-3">Roles</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('alats.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('alats.index') }}">
               <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="mx-3">Alat</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('kategoris.*') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('kategoris.index') }}">
               <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <span class="mx-3">Kategori</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('log-aktivitas.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('log-aktivitas.index') }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <span class="mx-3">Log Aktivitas</span>
            </a>

        <!-- Petugas Links -->
        @elseif($role == 'petugas')
            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dashboard.petugas') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('dashboard.petugas') }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('petugas.permintaan') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('petugas.permintaan') }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="mx-3">Permintaan</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('petugas.aktif') || request()->routeIs('petugas.kembali') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('petugas.aktif') }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="mx-3">Peminjaman Aktif</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('petugas.riwayat') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('petugas.riwayat') }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="mx-3">Riwayat Pengembalian</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('petugas.laporan.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('petugas.laporan.index') }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                <span class="mx-3">Laporan</span>
            </a>

        <!-- Peminjam Links -->
        @elseif($role == 'peminjam')
            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('dashboard.peminjam') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('dashboard.peminjam') }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('peminjam.alat') || request()->routeIs('peminjam.pinjam') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
               href="{{ route('peminjam.alat') }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span class="mx-3">Daftar Alat</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{ request()->routeIs('peminjam.pinjaman') || request()->routeIs('peminjam.pinjam') ? 'bg-gray-700 bg-opacity-25 text-gray-100 border-l-4 border-gray-100' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}"
   href="{{ route('peminjam.pinjaman') }}">

    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 5h11M9 12h11M9 19h11M4 6h.01M4 13h.01M4 20h.01"/>
    </svg>

    <span class="mx-3">Daftar Pinjaman</span>
</a>


        @endif
    </nav>
</div>
