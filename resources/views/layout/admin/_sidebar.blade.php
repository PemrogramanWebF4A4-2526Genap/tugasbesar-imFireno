<aside class="w-64 bg-slate-900 text-white">

    <div class="p-5">

        <h1 class="text-xl font-bold tracking-tight">
            JasaMarket
        </h1>

    </div>

    <nav class="px-3 space-y-1">

        <a wire:navigate href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors @yield('MenuActiveDashboard')">

            <i class="fas fa-home w-5 text-center"></i>
            Dashboard

        </a>

        <a wire:navigate href="{{ route('admin.user') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors @yield('MenuActiveUser')">

            <i class="fas fa-users w-5 text-center"></i>
            User

        </a>

        <a wire:navigate href="{{ route('admin.seller') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors @yield('MenuActiveSeller')">

            <i class="fas fa-store w-5 text-center"></i>
            Seller

        </a>

        <a wire:navigate href="{{ route('admin.kategori') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors @yield('MenuActiveKategori')">

            <i class="fas fa-tags w-5 text-center"></i>
            Kategori

        </a>

        <a wire:navigate href="{{ route('admin.jasa') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors @yield('MenuActiveJasa')">

            <i class="fas fa-screwdriver-wrench w-5 text-center"></i>
            Jasa

        </a>

        <a wire:navigate  href="{{ route('admin.pesanan') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors @yield('MenuActivePesanan')">

            <i class="fas fa-shopping-bag w-5 text-center"></i>
            Pesanan

        </a>

        <a wire:navigate  href="{{ route('admin.laporan') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors @yield('MenuActiveLaporan')">

            <i class="fas fa-chart-line w-5 text-center"></i>
            Laporan

        </a>

    </nav>

    <div class="absolute bottom-0 left-0 w-[260px] p-3">
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-3 py-2.5 w-full rounded-lg text-slate-300 hover:bg-red-500/20 hover:text-red-400 transition-colors">
                <i class="fas fa-right-from-bracket w-5 text-center"></i>
                Logout
            </button>
        </form>
    </div>

</aside>