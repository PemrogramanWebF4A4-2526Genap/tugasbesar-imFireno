<nav class="bg-white shadow-sm">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logojasamarket.png') }}" class="w-15 h-15" alt="Logo">

        </div>

        <div class="relative">
            @auth
            <button id="profileButton" class="flex items-center gap-3">

                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                    class="w-10 h-10 rounded-full border-2 border-blue-500">

            </button>

            <div id="profileMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border z-50">

                <div class="p-4 border-b">
                    <div class="flex">
                        <p class="font-semibold text-gray-800">
                            {{ Auth::user()->name }}
                        </p>
                        <span class="text-xs px-2 py-1 ml-3 bg-blue-100 text-blue-600 rounded">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-500">
                        {{ Auth::user()->email }}
                    </p>
                </div>

                <a href="/profile" class="block px-4 py-3 hover:bg-gray-100">
                    Profile
                </a>

                <form action="/logout" method="POST">
                    @csrf

                    <button class="w-full text-left px-4 py-3 text-red-500 hover:bg-red-50">
                        Logout
                    </button>
                </form>

            </div>
            @else
            <a href="/login" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Login
            </a>
            @endauth
        </div>

    </div>
</nav>
