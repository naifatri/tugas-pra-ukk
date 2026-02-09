<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900">Buat Akun</h2>
        <p class="text-gray-500 mt-2">Daftar untuk mulai meminjam alat.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nama Lengkap -->
        <div>
            <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" class="text-gray-700 font-medium" />
            <x-text-input id="nama_lengkap" class="block mt-1 w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="text" name="nama_lengkap" :value="old('nama_lengkap')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" />
            <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <!-- Username -->
            <div>
                <x-input-label for="username" :value="__('Username')" class="text-gray-700 font-medium" />
                <x-text-input id="username" class="block mt-1 w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="text" name="username" :value="old('username')" required autocomplete="username" placeholder="Username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Kelas -->
            <div>
                <x-input-label for="kelas" :value="__('Kelas')" class="text-gray-700 font-medium" />
                <x-text-input id="kelas" class="block mt-1 w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="text" name="kelas" :value="old('kelas')" required placeholder="Contoh: XII" />
                <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
            </div>
        </div>

        <!-- Jurusan -->
        <div>
            <x-input-label for="jurusan" :value="__('Jurusan')" class="text-gray-700 font-medium" />
            <x-text-input id="jurusan" class="block mt-1 w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="text" name="jurusan" :value="old('jurusan')" required placeholder="Contoh: Rekayasa Perangkat Lunak" />
            <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="Buat password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out transform hover:-translate-y-0.5">
                {{ __('Daftar Sekarang') }}
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-500 transition duration-150">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
