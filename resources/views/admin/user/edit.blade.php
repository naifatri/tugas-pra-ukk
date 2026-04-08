<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
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

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                                <input type="text" name="username" id="username" value="{{ $user->username }}" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('username') border-red-500 @enderror" required>
                                @error('username')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ $user->nama_lengkap }}" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('nama_lengkap') border-red-500 @enderror" required>
                                @error('nama_lengkap')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="kelas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelas</label>
                                <select name="kelas" id="kelas"
                                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('kelas') border-red-500 @enderror"
                                    required>
                                    <option value="">-- Pilih Kelas --</option>
                                    <optgroup label="X">
                                        <option value="X PPLG I" {{ $user->kelas == 'X PPLG I' ? 'selected' : '' }}>X PPLG I</option>
                                        <option value="X PPLG II" {{ $user->kelas == 'X PPLG II' ? 'selected' : '' }}>X PPLG II</option>
                                        <option value="X PPLG III" {{ $user->kelas == 'X PPLG III' ? 'selected' : '' }}>X PPLG III</option>
                                    </optgroup>
                                    <optgroup label="XI">
                                        <option value="XI PPLG I" {{ $user->kelas == 'XI PPLG I' ? 'selected' : '' }}>XI PPLG I</option>
                                        <option value="XI PPLG II" {{ $user->kelas == 'XI PPLG II' ? 'selected' : '' }}>XI PPLG II</option>
                                        <option value="XI PPLG III" {{ $user->kelas == 'XI PPLG III' ? 'selected' : '' }}>XI PPLG III</option>
                                    </optgroup>
                                    <optgroup label="XII">
                                        <option value="XII PPLG I" {{ $user->kelas == 'XII PPLG I' ? 'selected' : '' }}>XII PPLG I</option>
                                        <option value="XII PPLG II" {{ $user->kelas == 'XII PPLG II' ? 'selected' : '' }}>XII PPLG II</option>
                                        <option value="XII PPLG III" {{ $user->kelas == 'XII PPLG III' ? 'selected' : '' }}>XII PPLG III</option>
                                    </optgroup>
                                </select>
                                @error('kelas')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="jurusan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jurusan</label>
                                <select name="jurusan" id="jurusan"
                                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('jurusan') border-red-500 @enderror"
                                    required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="PPLG" {{ $user->jurusan == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                                    <option value="BC" {{ $user->jurusan == 'BC' ? 'selected' : '' }}>BC</option>
                                    <option value="TO" {{ $user->jurusan == 'TO' ? 'selected' : '' }}>TO</option>
                                    <option value="TPFL" {{ $user->jurusan == 'TPFL' ? 'selected' : '' }}>TPFL</option>
                                    <option value="ANIMASI" {{ $user->jurusan == 'ANIMASI' ? 'selected' : '' }}>ANIMASI</option>
                                </select>
                                @error('jurusan')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="role_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                                <select name="role_id" id="role_id" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('role_id') border-red-500 @enderror" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->nama_role }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="status_akun" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Akun</label>
                                <select name="status_akun" id="status_akun" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('status_akun') border-red-500 @enderror" required>
                                    <option value="aktif" {{ $user->status_akun == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ $user->status_akun == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status_akun')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
