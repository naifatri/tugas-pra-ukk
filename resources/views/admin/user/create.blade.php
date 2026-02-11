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
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                                <input type="text" name="username" id="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="kelas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Kelas
                                </label>

                                <select name="kelas" id="kelas"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required>

                                    <option value="">-- Pilih Kelas --</option>

                                    <optgroup label="X">
                                        <option value="X PPLG I">X PPLG I</option>
                                        <option value="X PPLG II">X PPLG II</option>
                                        <option value="X PPLG III">X PPLG III</option>
                                    </optgroup>

                                    <optgroup label="XI">
                                        <option value="XI PPLG I">XI PPLG I</option>
                                        <option value="XI PPLG II">XI PPLG II</option>
                                        <option value="XI PPLG III">XI PPLG III</option>
                                    </optgroup>

                                    <optgroup label="XII">
                                        <option value="XII PPLG I">XII PPLG I</option>
                                        <option value="XII PPLG II">XII PPLG II</option>
                                        <option value="XII PPLG III">XII PPLG III</option>
                                    </optgroup>

                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="jurusan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Jurusan
                                </label>

                                <select name="jurusan" id="jurusan"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required>

                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="PPLG">PPLG</option>
                                    <option value="BC">BC</option>
                                    <option value="TO">TO</option>
                                    <option value="TPFL">TPFL</option>
                                    <option value="ANIMASI">ANIMASI</option>

                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="role_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                                <select name="role_id" id="role_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="status_akun" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Akun</label>
                                <select name="status_akun" id="status_akun" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
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
