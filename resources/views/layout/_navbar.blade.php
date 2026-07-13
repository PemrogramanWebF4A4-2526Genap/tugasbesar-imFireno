<nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-2 group">
            <div class="w-10 h-10 bg-emerald-600 text-white flex items-center justify-center rounded-xl shadow-sm group-hover:scale-105 transition-transform">
                <i class="fas fa-layer-group text-xl"></i>
            </div>
            <span class="font-bold text-xl tracking-tight text-gray-900 group-hover:text-emerald-600 transition-colors">JasaMarket</span>
        </a>

        <!-- Menu / Auth -->
        <div class="relative flex items-center gap-4">
            @auth
            <!-- Notification -->
            <div class="relative">
                @livewire('notifications')
            </div>

            <button id="profileButton" class="flex items-center gap-3 hover:bg-gray-50 px-2 py-1 rounded-full transition-colors">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff"
                    class="w-9 h-9 rounded-full shadow-sm ring-2 ring-emerald-50 ring-offset-1">
                <div class="hidden md:block text-left">
                    <p class="text-sm font-semibold text-gray-800 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 mt-1 capitalize">{{ Auth::user()->role }}</p>
                </div>
                <i class="fas fa-chevron-down text-gray-400 text-xs ml-1"></i>
            </button>

            <!-- Dropdown -->
            <div id="profileMenu" class="hidden absolute right-0 top-full mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 overflow-hidden origin-top-right transition-all">
                <div class="p-4 bg-gray-50/50 border-b border-gray-100">
                    <p class="font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate mt-1">{{ Auth::user()->email }}</p>
                </div>

                <div class="p-2">
                    
                    <form action="/logout" method="POST" class="mt-1">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                            <i class="fas fa-sign-out-alt w-4"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="flex items-center gap-3">
                <a href="/login" class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:text-emerald-600 transition-colors">Masuk</a>
                <a href="/register" class="px-5 py-2.5 text-sm font-medium bg-gray-900 text-white rounded-full hover:bg-emerald-600 hover:shadow-md transition-all">Daftar</a>
            </div>
            @endauth
        </div>
    </div>
</nav>
