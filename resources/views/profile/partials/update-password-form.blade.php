<section>
    <header>
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Keamanan Akun') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang kuat dan unik.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div class="grid grid-cols-1 gap-6">
            <!-- Current Password -->
            <div>
                <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" class="text-gray-700 font-semibold mb-1" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all duration-200" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- New Password -->
                <div>
                    <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" class="text-gray-700 font-semibold mb-1" />
                    <x-text-input id="update_password_password" name="password" type="password" class="block w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all duration-200" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-gray-700 font-semibold mb-1" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all duration-200" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-indigo-300 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:shadow-none">
                {{ __('Perbarui Kata Sandi') }}
            </button>

            @if (session('status') === 'password-updated')
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
                        {{ __('Berhasil diperbarui.') }}
                    </span>
                </p>
            @endif
        </div>
    </form>
</section>

