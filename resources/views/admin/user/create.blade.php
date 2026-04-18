<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Display validation errors --}}
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-red-800 dark:text-red-200 mb-3">Terjadi Kesalahan:</h4>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm text-red-700 dark:text-red-300">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username') }}" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('username') border-red-500 @enderror" required>
                                @error('username')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('password') border-red-500 @enderror" required>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="nomor_whatsapp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor WhatsApp</label>
                                <input type="text" name="nomor_whatsapp" id="nomor_whatsapp" value="{{ old('nomor_whatsapp') }}" placeholder="081234567890" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('nomor_whatsapp') border-red-500 @enderror">
                                @error('nomor_whatsapp')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('nama_lengkap') border-red-500 @enderror" required>
                                @error('nama_lengkap')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="kelas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Kelas
                                </label>
                                <select name="kelas" id="kelas"
                                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('kelas') border-red-500 @enderror"
                                    required>
                                    <option value="">-- Pilih Kelas --</option>
                                    <optgroup label="X">
                                        <option value="X PPLG I" {{ old('kelas') == 'X PPLG I' ? 'selected' : '' }}>X PPLG I</option>
                                        <option value="X PPLG II" {{ old('kelas') == 'X PPLG II' ? 'selected' : '' }}>X PPLG II</option>
                                        <option value="X PPLG III" {{ old('kelas') == 'X PPLG III' ? 'selected' : '' }}>X PPLG III</option>
                                    </optgroup>
                                    <optgroup label="XI">
                                        <option value="XI PPLG I" {{ old('kelas') == 'XI PPLG I' ? 'selected' : '' }}>XI PPLG I</option>
                                        <option value="XI PPLG II" {{ old('kelas') == 'XI PPLG II' ? 'selected' : '' }}>XI PPLG II</option>
                                        <option value="XI PPLG III" {{ old('kelas') == 'XI PPLG III' ? 'selected' : '' }}>XI PPLG III</option>
                                    </optgroup>
                                    <optgroup label="XII">
                                        <option value="XII PPLG I" {{ old('kelas') == 'XII PPLG I' ? 'selected' : '' }}>XII PPLG I</option>
                                        <option value="XII PPLG II" {{ old('kelas') == 'XII PPLG II' ? 'selected' : '' }}>XII PPLG II</option>
                                        <option value="XII PPLG III" {{ old('kelas') == 'XII PPLG III' ? 'selected' : '' }}>XII PPLG III</option>
                                    </optgroup>
                                </select>
                                @error('kelas')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="jurusan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Jurusan
                                </label>
                                <select name="jurusan" id="jurusan"
                                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('jurusan') border-red-500 @enderror"
                                    required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="PPLG" {{ old('jurusan') == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                                    <option value="BC" {{ old('jurusan') == 'BC' ? 'selected' : '' }}>BC</option>
                                    <option value="TO" {{ old('jurusan') == 'TO' ? 'selected' : '' }}>TO</option>
                                    <option value="TPFL" {{ old('jurusan') == 'TPFL' ? 'selected' : '' }}>TPFL</option>
                                    <option value="ANIMASI" {{ old('jurusan') == 'ANIMASI' ? 'selected' : '' }}>ANIMASI</option>
                                </select>
                                @error('jurusan')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="role_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                                <select name="role_id" id="role_id" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('role_id') border-red-500 @enderror" required>
                                    <option value="">-- Pilih Role --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->nama_role }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="status_akun" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Akun</label>
                                <select name="status_akun" id="status_akun" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('status_akun') border-red-500 @enderror" required>
                                    <option value="aktif" {{ old('status_akun') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status_akun') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status_akun')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
