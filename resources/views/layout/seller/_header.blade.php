<div class="bg-white border-b border-gray-200 px-8 py-4 sticky top-0 z-10">

    <div class="flex justify-between items-center">

        <div>

            <h2 class="text-xl font-bold text-gray-900">
                @yield('title')
            </h2>

        </div>

        <div class="flex items-center gap-4">

            <button class="relative p-2 text-gray-500 hover:text-gray-700 transition-colors">
                <i class="fas fa-bell text-xl"></i>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>

            <div class="flex items-center gap-3 pl-4 border-l border-gray-200">

                <img
                    src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=10b981&color=fff"
                    class="w-10 h-10 rounded-full">

                <div>

                    <h4 class="font-semibold text-gray-900 text-sm">
                        {{ auth()->user()->name }}
                    </h4>

                    <p class="text-xs text-gray-500">
                        Penjual
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>