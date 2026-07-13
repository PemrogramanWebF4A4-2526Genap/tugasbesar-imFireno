<aside class="w-64 bg-white border-r border-gray-200 fixed h-full">

    <div class="p-6 border-b border-gray-100">

        <h1 class="text-xl font-bold text-emerald-600">
            JasaMarket
        </h1>

        <p class="text-gray-400 text-xs mt-1">
            Seller Panel
        </p>

    </div>

    <nav class="p-4 space-y-1">

        <a wire:navigate href="{{ route('seller.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 font-medium @yield('MenuActiveDashboard')">

            <i class="fas fa-home w-5 text-center"></i>
            Dashboard

        </a>

        <a wire:navigate href="{{ route('seller.service.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 transition-colors @yield('MenuActiveService')">

            <i class="fas fa-box w-5 text-center"></i>
            Jasa Saya

        </a>

        <a wire:navigate href="{{ route('seller.pesanan') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors @yield('MenuActivePesanan')">

            <i class="fas fa-shopping-bag w-5 text-center"></i>
            Pesanan

        </a>

        <a wire:navigate href="{{ route('seller.laporan') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors @yield('MenuActiveLaporan')">

            <i class="fas fa-chart-line w-5 text-center"></i>
            Laporan

        </a>

    </nav>

    <div class="absolute bottom-0 left-0 w-64 p-4 border-t border-gray-100">
        <form action="/logout" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 px-4 py-3 w-full rounded-lg text-red-500 hover:bg-red-50 transition-colors">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                Logout
            </button>
        </form>
    </div>

</aside>