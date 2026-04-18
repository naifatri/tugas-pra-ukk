<header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
    @php
        $unreadNotifications = Auth::user()->unreadNotifications()->latest()->limit(5)->get();
        $recentNotifications = Auth::user()->notifications()->latest()->limit(5)->get();
        $notificationItems = $unreadNotifications->isNotEmpty() ? $unreadNotifications : $recentNotifications;
    @endphp

    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

        <div class="relative mx-4 lg:mx-0">
            <h1 class="text-2xl font-semibold text-gray-800">{{ $header ?? 'Dashboard' }}</h1>
        </div>
    </div>

    <div class="flex items-center">
        <div x-data="{ notifOpen: false }" class="relative mr-4">
            <button @click="notifOpen = ! notifOpen"
                class="relative flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-600 shadow-sm transition hover:border-indigo-300 hover:text-indigo-600 focus:outline-none">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z" />
                </svg>
                @if(Auth::user()->unreadNotifications->count() > 0)
                    <span class="absolute -right-1 -top-1 min-w-[1.25rem] rounded-full bg-rose-500 px-1.5 py-0.5 text-center text-xs font-bold text-white">
                        {{ Auth::user()->unreadNotifications->count() > 9 ? '9+' : Auth::user()->unreadNotifications->count() }}
                    </span>
                @endif
            </button>

            <div x-show="notifOpen" @click="notifOpen = false" class="fixed inset-0 z-10" style="display: none;"></div>

            <div x-show="notifOpen"
                class="absolute right-0 z-20 mt-2 w-96 max-w-[calc(100vw-2rem)] overflow-hidden rounded-xl border border-gray-100 bg-white shadow-xl"
                style="display: none;">
                <div class="flex items-center justify-between border-b border-gray-100 px-4 py-3">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Notifikasi</p>
                        <p class="text-xs text-gray-500">Update terbaru untuk akun Anda</p>
                    </div>
                    <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700">
                        {{ Auth::user()->unreadNotifications->count() }} belum dibaca
                    </span>
                </div>

                <div class="max-h-96 overflow-y-auto">
                    @forelse($notificationItems as $notification)
                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                            @csrf
                            <button type="submit"
                                class="block w-full border-b border-gray-100 px-4 py-3 text-left transition hover:bg-gray-50 {{ is_null($notification->read_at) ? 'bg-indigo-50/60' : 'bg-white' }}">
                                <div class="flex items-start gap-3">
                                    <span class="mt-1 h-2.5 w-2.5 flex-shrink-0 rounded-full {{ is_null($notification->read_at) ? 'bg-indigo-500' : 'bg-gray-300' }}"></span>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $notification->data['title'] ?? 'Notifikasi baru' }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ $notification->data['message'] ?? '-' }}
                                        </p>
                                        <p class="mt-2 text-xs text-gray-400">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </button>
                        </form>
                    @empty
                        <div class="px-4 py-8 text-center text-sm text-gray-500">
                            Belum ada notifikasi.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = ! dropdownOpen"
                class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                @if(Auth::user()->foto)
                    <img class="h-full w-full object-cover"
                        src="{{ asset('storage/' . Auth::user()->foto) }}"
                        alt="{{ Auth::user()->nama_lengkap }}">
                @else
                    <img class="h-full w-full object-cover"
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=6366f1&color=fff"
                        alt="{{ Auth::user()->nama_lengkap }}">
                @endif
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
                style="display: none;"></div>

            <div x-show="dropdownOpen"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20"
                style="display: none;">
                <div class="px-4 py-2 bg-indigo-50 border-b border-indigo-100">
                    <p class="text-sm text-gray-600">Signed in as</p>
                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->nama_lengkap }}</p>
                </div>
                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                </form>
            </div>
        </div>
    </div>
</header>
