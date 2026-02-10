<section>
    <header>
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Perbarui informasi profil akun dan username Anda.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Photo Upload -->
        <div class="flex flex-col items-center gap-4 sm:flex-row">
            <div class="relative group">
                <div id="photo-preview-container" class="h-24 w-24 overflow-hidden rounded-2xl ring-4 ring-indigo-50 shadow-md dark:ring-gray-700">
                    @if($user->foto)
                        <img id="photo-preview" src="{{ asset('storage/' . $user->foto) }}" alt="Preview" class="h-full w-full object-cover">
                    @else
                        <div id="photo-placeholder" class="flex h-full w-full items-center justify-center bg-indigo-100 text-2xl font-bold text-indigo-600 dark:bg-gray-700 dark:text-indigo-400">
                            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                        </div>
                        <img id="photo-preview" src="" alt="Preview" class="hidden h-full w-full object-cover">
                    @endif
                </div>
                <label for="foto" class="absolute -bottom-2 -right-2 flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-white text-indigo-600 shadow-lg ring-1 ring-gray-200 transition-all hover:scale-110 hover:bg-indigo-600 hover:text-white dark:bg-gray-800 dark:ring-gray-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <input id="foto" name="foto" type="file" class="hidden" accept="image/*" onchange="previewImage(this)">
                </label>
            </div>
            <div class="text-center sm:text-left">
                <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100">Foto Profil</h4>
                <p class="text-xs text-gray-500">JPG, PNG atau WebP (Maks. 2MB)</p>
                <x-input-error class="mt-1" :messages="$errors->get('foto')" />
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Nama Lengkap -->
            <div class="md:col-span-2">
                <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" class="text-gray-700 font-semibold mb-1" />
                <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="block w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all duration-200" :value="old('nama_lengkap', $user->nama_lengkap)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap')" />
            </div>

            <!-- Username -->
            <div>
                <x-input-label for="username" :value="__('Username')" class="text-gray-700 font-semibold mb-1" />
                <x-text-input id="username" name="username" type="text" class="block w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all duration-200" :value="old('username', $user->username)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
            </div>

            <!-- Kelas -->
            <div>
                <x-input-label for="kelas" :value="__('Kelas')" class="text-gray-700 font-semibold mb-1" />
                <x-text-input id="kelas" name="kelas" type="text" class="block w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all duration-200" :value="old('kelas', $user->kelas)" placeholder="Contoh: XII" />
                <x-input-error class="mt-2" :messages="$errors->get('kelas')" />
            </div>

            <!-- Jurusan -->
            <div class="md:col-span-2">
                <x-input-label for="jurusan" :value="__('Jurusan')" class="text-gray-700 font-semibold mb-1" />
                <x-text-input id="jurusan" name="jurusan" type="text" class="block w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all duration-200" :value="old('jurusan', $user->jurusan)" placeholder="Contoh: Rekayasa Perangkat Lunak" />
                <x-input-error class="mt-2" :messages="$errors->get('jurusan')" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-indigo-300 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:shadow-none">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-green-600 dark:text-green-400"
                >
                    <span class="flex items-center gap-1">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Berhasil disimpan.') }}
                    </span>
                </p>
            @endif
        </div>
    </form>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</section>

