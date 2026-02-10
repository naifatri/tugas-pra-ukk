<x-app-layout>
    <x-slot name="header">
        {{ __('Profil') }}
    </x-slot>

    <div class="-mx-6 -mt-6">
        <!-- Main Header Section - Lower Z-Index -->
        <div class="relative z-0 overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 pb-28 pt-8 shadow-md">
            <div class="absolute inset-0 opacity-10">
                <svg class="h-full w-full" fill="none" viewBox="0 0 400 400">
                    <defs>
                        <pattern id="pattern-hex-compact" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
                            <path d="M15 0L30 7.5V22.5L15 30L0 22.5V7.5L15 0Z" fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#pattern-hex-compact)" />
                </svg>
            </div>
            
            <div class="relative mx-auto max-w-7xl px-6 sm:px-8 lg:px-10">
                <div class="text-left">
                    <h2 class="text-2xl font-black tracking-tight text-white sm:text-3xl">
                        {{ __('Pengaturan Profil') }}
                    </h2>
                    <p class="mt-1 text-sm text-indigo-100/90 max-w-xl">
                        {{ __('Kelola informasi identitas dan keamanan akun Anda.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Content Section - Higher Z-Index to overlap safely -->
        <div class="relative z-10 mx-auto -mt-12 max-w-7xl px-6 pb-12 sm:px-8 lg:px-10">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
                <!-- Sidebar Info Card -->
                <div class="lg:col-span-4">
                    <div class="sticky top-6 overflow-hidden rounded-2xl bg-white shadow-xl ring-1 ring-black/5 dark:bg-gray-800">
                        <div class="relative h-24 bg-indigo-50 dark:bg-gray-700/50">
                            <div class="absolute inset-0 opacity-10">
                                <svg class="h-full w-full" fill="none" viewBox="0 0 100 100" preserveAspectRatio="none">
                                    <path d="M0 100C30 0 70 0 100 100" fill="currentColor" class="text-indigo-400" />
                                </svg>
                            </div>
                        </div>
                        <div class="relative -mt-12 flex flex-col items-center px-6 pb-8 text-center">
                            <div class="relative">
                                @if($user->foto)
                                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Profile" class="h-28 w-28 rounded-3xl border-4 border-white object-cover shadow-lg hover:scale-105 transition-transform duration-300 dark:border-gray-800">
                                @else
                                    <div class="flex h-28 w-28 items-center justify-center rounded-3xl border-4 border-white bg-gradient-to-br from-indigo-500 to-purple-600 text-3xl font-black text-white shadow-lg dark:border-gray-800">
                                        {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="absolute bottom-1 right-1 h-5 w-5 rounded-full border-2 border-white bg-green-500 shadow-sm dark:border-gray-800"></div>
                            </div>
                            
                            <h3 class="mt-4 text-xl font-extrabold text-gray-900 dark:text-white">{{ $user->nama_lengkap }}</h3>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-400">{{ $user->role->nama_role ?? 'User' }}</p>
                            
                            <div class="mt-6 flex w-full flex-col gap-2 rounded-xl bg-gray-50 p-4 text-left dark:bg-gray-700/30">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-bold uppercase text-gray-400">Username</span>
                                    <span class="text-sm font-bold text-gray-900 dark:text-gray-200">{{ $user->username }}</span>
                                </div>
                                <div class="flex flex-col mt-2">
                                    <span class="text-[10px] font-bold uppercase text-gray-400">Kelas & Jurusan</span>
                                    <span class="text-sm font-bold text-gray-900 dark:text-gray-200">{{ ($user->kelas ?: '-') . ' ' . ($user->jurusan ?: '') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Forms Section -->
                <div class="space-y-6 lg:col-span-8">
                    <!-- Cards with standardized padding -->
                    <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-800">
                        <div class="p-6 sm:p-8">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-800">
                        <div class="p-6 sm:p-8">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-800">
                        <div class="p-6 sm:p-8">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


