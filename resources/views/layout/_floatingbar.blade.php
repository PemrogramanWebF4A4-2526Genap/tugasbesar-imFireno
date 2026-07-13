<div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-40">
    <div class="flex items-center gap-1 bg-white/90 backdrop-blur-xl border border-gray-200/50 shadow-2xl shadow-gray-900/10 rounded-2xl px-2 py-2">
        
        <!-- Home -->
        <a wire:navigate href="{{ route('pembeli.home') }}"
            title="Beranda"
            class="@yield('FloatingActiveHome') flex items-center justify-center w-12 h-12 rounded-xl hover:bg-emerald-50 transition-all duration-300 group">
            <i class="fas fa-home text-lg text-gray-600 group-hover:text-emerald-600 transition-colors"></i>
        </a>

        <!-- Chart -->
        <a wire:navigate href="{{ route('pembeli.keranjang') }}"
            title="Keranjang"
            class="@yield('FloatingActiveKeranjang') flex items-center justify-center w-12 h-12 rounded-xl hover:bg-emerald-50 transition-all duration-300 group relative">
            <i class="fas fa-cart-shopping text-lg text-gray-600 group-hover:text-emerald-600 transition-colors"></i>
            
            @php $cartCount = count(session('cart', [])); @endphp
            @if($cartCount > 0)
                <span class="absolute -top-1 -right-1 bg-emerald-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full min-w-[1.25rem] text-center border-2 border-white shadow-sm">
                    {{ $cartCount }}
                </span>
            @endif
        </a>

        <!-- Pesanan -->
        <a wire:navigate href="{{ route('pembeli.pesanan') }}"
            title="Pesanan"
            class="@yield('FloatingActivePesanan') flex items-center justify-center w-12 h-12 rounded-xl hover:bg-emerald-50 transition-all duration-300 group">
            <i class="fas fa-receipt text-lg text-gray-600 group-hover:text-emerald-600 transition-colors"></i>
        </a>

        <!-- Category -->
        <a wire:navigate href="{{ route('pembeli.kategori') }}"
            title="Kategori"
            class="@yield('FloatingActiveKategori') flex items-center justify-center w-12 h-12 rounded-xl hover:bg-emerald-50 transition-all duration-300 group">
            <i class="fas fa-list text-lg text-gray-600 group-hover:text-emerald-600 transition-colors"></i>
        </a>

    </div>
</div>