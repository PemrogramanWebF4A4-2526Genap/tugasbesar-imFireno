<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Keranjang Belanja</h1>
        <p class="text-gray-500">Kelola jasa yang ingin Anda pesan</p>
    </div>

    @if(count($cart) > 0)
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart as $item)
                    <div class="bg-white rounded-2xl shadow-sm border {{ in_array($item['id'], $selectedItems) ? 'border-emerald-500 ring-2 ring-emerald-100' : 'border-gray-100' }} p-6 hover:shadow-md transition-shadow cursor-pointer" 
                         wire:click="toggleSelection({{ $item['id'] }})">
                        <div class="flex gap-4 items-center">
                            <!-- Checkbox -->
                            <div class="flex-shrink-0" wire:ignore.self>
                                <input type="checkbox" wire:model.live="selectedItems" value="{{ $item['id'] }}" 
                                       class="w-5 h-5 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500 cursor-pointer"
                                       id="item-{{ $item['id'] }}"
                                       wire:click.stop>
                            </div>

                            <!-- Thumbnail -->
                            <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                                @if(isset($item['thumbnail']) && $item['thumbnail'])
                                    <img src="{{ asset('storage/' . $item['thumbnail']) }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-gray-300 text-2xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start mb-2">
                                    <label for="item-{{ $item['id'] }}" class="font-bold text-gray-900 truncate cursor-pointer" wire:click.stop>{{ $item['name'] }}</label>
                                    <button wire:click.stop="removeFromCart({{ $item['id'] }})" 
                                            class="text-gray-400 hover:text-red-500 transition-colors p-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                
                                <p class="text-sm text-gray-500 mb-2">
                                    <i class="fas fa-user mr-1"></i> {{ $item['seller_name'] }}
                                </p>
                                
                                @if(isset($item['duration']))
                                    <p class="text-sm text-gray-400 mb-3">
                                        <i class="fas fa-clock mr-1"></i> {{ $item['duration'] }}
                                    </p>
                                @endif

                                <p class="font-bold text-emerald-600">
                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Jasa di Keranjang</span>
                            <span>{{ count($cart) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Jasa Terpilih</span>
                            <span class="font-semibold text-emerald-600">{{ count($selectedItems) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Layanan</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between font-bold text-lg text-gray-900">
                                <span>Total</span>
                                <span class="text-emerald-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button wire:click="checkout" class="w-full py-3 {{ count($selectedItems) > 0 ? 'bg-emerald-600 hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-500/25 text-white' : 'bg-gray-200 text-gray-400 cursor-not-allowed' }} rounded-xl font-semibold transition-all"
                            {{ count($selectedItems) > 0 ? '' : 'disabled' }}>
                            Checkout
                        </button>
                        <button wire:click="clearCart" class="w-full py-3 border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                            Kosongkan Keranjang
                        </button>
                    </div>

                    <div class="mt-6 p-4 bg-emerald-50 rounded-xl">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-shield-alt text-emerald-600 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-emerald-800">Pembayaran Aman</p>
                                <p class="text-xs text-emerald-600">Transaksi Anda dilindungi dengan enkripsi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-16">
            <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shopping-cart text-5xl text-gray-300"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Keranjang Kosong</h3>
            <p class="text-gray-500 mb-6">Anda belum menambahkan jasa apapun ke keranjang</p>
            <a href="/home" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-colors">
                <i class="fas fa-search"></i>
                Cari Jasa
            </a>
        </div>
    @endif
</div>
