<x-guest-layout>
    <div class="min-h-screen h-screen flex w-full bg-gradient-to-br from-blue-50 via-white to-blue-100 overflow-hidden">
        <!-- Left Side - Branding Section -->
        <div class="hidden lg:flex lg:w-1/2 relative h-full overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-blue-500 to-cyan-400"></div>
            
            <!-- Animated Wave Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill="white" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,208C1248,224,1344,192,1392,176L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>

            <!-- Floating Orbs -->
            <div class="absolute top-20 left-10 w-64 h-64 bg-blue-400/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-80 h-80 bg-cyan-300/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>

            <!-- Dot Pattern Overlay -->
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 40px 40px;"></div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-center items-center w-full h-full px-12 text-center">
                
                <!-- LOGO SIPUT - DIPERBESAR -->
                <div class="mb-8 transform hover:scale-105 transition-all duration-500">
                    <div class="relative inline-block">
                        <div class="absolute inset-0 bg-white/20 rounded-3xl blur-2xl transform scale-110"></div>
                        <img src="{{ asset('assets/logo-siput.png') }}" alt="SIPUT Logo" class="relative w-64 h-auto object-contain drop-shadow-2xl">
                    </div>
                </div>

                <!-- App Name & Tagline -->
                <div class="space-y-3">
                    <div class="space-y-1">
                        <p class="text-2xl font-bold text-blue-100">
                            Sistem Peminjaman Alat
                        </p>
                        <p class="text-xl text-blue-200/90 font-medium">
                            yang Modern & Efisien
                        </p>
                    </div>
                </div>

                <!-- Feature Cards -->
                <div class="mt-12 grid grid-cols-1 gap-4 w-full max-w-md">
                    <div class="group flex items-center gap-4 p-5 bg-white/10 backdrop-blur-md rounded-xl border border-white/20 hover:bg-white/20 transition-all duration-300 cursor-default">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-white font-semibold text-lg">Mudah Digunakan</span>
                    </div>
                    
                    <div class="group flex items-center gap-4 p-5 bg-white/10 backdrop-blur-md rounded-xl border border-white/20 hover:bg-white/20 transition-all duration-300 cursor-default">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-white font-semibold text-lg">Real-time Tracking</span>
                    </div>
                    
                    <div class="group flex items-center gap-4 p-5 bg-white/10 backdrop-blur-md rounded-xl border border-white/20 hover:bg-white/20 transition-all duration-300 cursor-default">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-white font-semibold text-lg">Terintegrasi Penuh</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="absolute bottom-6 left-0 right-0 text-center">
                <p class="text-blue-200/70 text-sm font-medium">
                    © {{ date('Y') }} SIPUT. All rights reserved.
                </p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center h-full p-6 lg:p-12 relative overflow-y-auto">
            <!-- Subtle Background Pattern -->
            <div class="absolute inset-0 opacity-30 pointer-events-none">
                <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200/50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-cyan-200/50 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
            </div>

            <!-- FORM CONTAINER -->
            <div class="w-full max-w-md relative z-10 my-auto">
                
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <div class="inline-block p-4 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl shadow-xl mb-4">
                        <img src="{{ asset('assets/siput.logo.png') }}" alt="SIPUT Logo" class="w-64 h-auto object-contain">
                    </div>
                    <h1 class="text-3xl font-black text-blue-600">SIPUT</h1>
                    <p class="text-gray-500 text-sm mt-1">Sistem Peminjaman Alat</p>
                </div>

                <!-- Welcome Card -->
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/50 p-8">
                    
                    <!-- Welcome Text -->
                    <div class="mb-6 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl shadow-lg mb-3">
                            <span class="text-2xl">👋</span>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-1">Selamat Datang!</h2>
                        <p class="text-gray-500 text-sm">Masuk untuk mengakses sistem peminjaman alat</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <!-- Username -->
                        <div class="space-y-1">
                            <x-input-label for="username" :value="__('Username')" class="text-gray-700 font-semibold text-xs uppercase tracking-wider" />
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <x-text-input id="username" 
                                    class="block w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/10 rounded-lg transition-all duration-200 placeholder-gray-400 text-gray-800 text-sm" 
                                    type="text" 
                                    name="username" 
                                    :value="old('username')" 
                                    required 
                                    autofocus 
                                    autocomplete="username" 
                                    placeholder="Masukkan username" />
                            </div>
                            <x-input-error :messages="$errors->get('username')" class="mt-1 text-xs" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-1">
                            <div class="flex items-center justify-between">
                                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold text-xs uppercase tracking-wider" />
                                @if (Route::has('password.request'))
                                    <a class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors duration-200" href="{{ route('password.request') }}">
                                        {{ __('Lupa password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <x-text-input id="password" 
                                    class="block w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/10 rounded-lg transition-all duration-200 placeholder-gray-400 text-gray-800 text-sm"
                                    type="password"
                                    name="password"
                                    required 
                                    autocomplete="current-password"
                                    placeholder="Masukkan password" />
                                
                                <!-- Toggle Password -->
                                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-blue-500 focus:outline-none transition-colors duration-200">
                                    <svg id="eye-icon" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between pt-1">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                                <input id="remember_me" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" name="remember">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-800 transition-colors font-medium">{{ __('Ingat saya') }}</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" class="w-full group relative flex justify-center items-center gap-2 py-3 px-4 border-0 rounded-xl shadow-lg shadow-blue-500/30 text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition-all duration-300 ease-out transform hover:-translate-y-0.5">
                                <span>{{ __('Masuk') }}</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="relative my-4">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-xs">
                                <span class="px-2 bg-white text-gray-400 font-medium">atau</span>
                            </div>
                        </div>

                        <!-- Register Button -->
                        <a href="{{ route('register') }}" class="group w-full inline-flex justify-center items-center gap-2 py-3 px-4 border-2 border-blue-200 rounded-xl text-sm font-bold text-blue-600 bg-blue-50/50 hover:bg-blue-100 hover:border-blue-300 hover:text-blue-700 transition-all duration-200">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            {{ __('Daftar Akun Baru') }}
                        </a>
                    </form>
                </div>
                
                <!-- Footer Text -->
                <p class="text-center text-gray-400 text-xs mt-4">
                    Dilindungi oleh sistem keamanan terbaik
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }
    </script>
</x-guest-layout>