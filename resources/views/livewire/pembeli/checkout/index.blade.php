<div class="container mx-auto px-6 py-8">
    <!-- Simple Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('pembeli.keranjang') }}" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left text-gray-600"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Checkout</h1>
                <p class="text-sm text-gray-500">Review pesanan Anda dan selesaikan pembayaran</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                <i class="fas fa-user text-white"></i>
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>

    <!-- Steps Indicator -->
    <div class="flex items-center justify-center mb-10">
        <div class="flex items-center">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold">1</div>
                <span class="ml-2 font-medium text-emerald-600 hidden sm:block">Keranjang</span>
            </div>
            <div class="w-16 h-0.5 bg-emerald-600 mx-4"></div>
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold">2</div>
                <span class="ml-2 font-medium text-emerald-600 hidden sm:block">Checkout</span>
            </div>
            <div class="w-16 h-0.5 bg-gray-200 mx-4"></div>
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">3</div>
                <span class="ml-2 font-medium text-gray-500 hidden sm:block">Pembayaran</span>
            </div>
            <div class="w-16 h-0.5 bg-gray-200 mx-4"></div>
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">4</div>
                <span class="ml-2 font-medium text-gray-500 hidden sm:block">Selesai</span>
            </div>
        </div>
    </div>

    @if(count($selectedItems) > 0)
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Order Items -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Job Description Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-edit text-emerald-600"></i>
                        Deskripsi Pekerjaan
                    </h2>
                    <p class="text-sm text-gray-500 mb-4">Jelaskan detail pekerjaan yang Anda butuhkan agar penjual dapat memahami kebutuhan Anda dengan lebih baik.</p>
                    <textarea wire:model.live="jobDescription" 
                              placeholder="Contoh: Saya butuh desain logo untuk bisnis kopi dengan nuansa modern dan minimalis..."
                              class="w-full h-32 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 resize-none text-sm text-gray-700 placeholder-gray-400"
                              maxlength="1000"></textarea>
                    <div class="flex justify-between mt-2">
                        <span class="text-xs text-gray-400">Opsional</span>
                        <span class="text-xs text-gray-400">{{ strlen($jobDescription) }}/1000</span>
                    </div>
                    @error('jobDescription')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order Items Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-shopping-bag text-emerald-600"></i>
                        Item Pesanan
                    </h2>
                    <div class="space-y-4">
                        @foreach($selectedItems as $id)
                            @if(isset($cart[$id]))
                                <div class="border border-gray-100 rounded-xl p-4 hover:border-emerald-200 hover:bg-emerald-50/50 transition-all">
                                    <div class="flex gap-4">
                                        <!-- Thumbnail -->
                                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                                            @if(isset($cart[$id]['thumbnail']) && $cart[$id]['thumbnail'])
                                                <img src="{{ asset('storage/' . $cart[$id]['thumbnail']) }}" 
                                                     alt="{{ $cart[$id]['name'] }}" 
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-image text-gray-300 text-xl"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-gray-900 mb-1">{{ $cart[$id]['name'] }}</h3>
                                            <p class="text-sm text-gray-500 mb-2">
                                                <i class="fas fa-store mr-1"></i> {{ $cart[$id]['seller_name'] }}
                                            </p>
                                            
                                            @if(isset($cart[$id]['duration']))
                                                <p class="text-xs text-gray-400 mb-2">
                                                    <i class="fas fa-clock mr-1"></i> {{ $cart[$id]['duration'] }}
                                                </p>
                                            @endif

                                            <p class="font-bold text-emerald-600">
                                                Rp {{ number_format($cart[$id]['price'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-receipt text-emerald-600"></i>
                        Ringkasan Pembayaran
                    </h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600 py-2 border-b border-gray-100">
                            <span>Total Item</span>
                            <span class="font-semibold">{{ count($selectedItems) }} jasa</span>
                        </div>
                        <div class="flex justify-between text-gray-600 py-2 border-b border-gray-100">
                            <span>Subtotal</span>
                            <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 py-2 border-b border-gray-100">
                            <span>Biaya Layanan</span>
                            <span class="font-semibold text-emerald-600">Gratis</span>
                        </div>
                        <div class="flex justify-between font-bold text-xl text-gray-900 py-4 bg-emerald-50 rounded-xl px-4">
                            <span>Total Pembayaran</span>
                            <span class="text-emerald-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button wire:click="processPayment" class="w-full py-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-xl font-bold text-lg transition-all shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 flex items-center justify-center gap-2">
                            <i class="fas fa-credit-card"></i>
                            Bayar Sekarang
                        </button>
                        <a href="{{ route('pembeli.keranjang') }}" class="block w-full py-3 border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors text-center flex items-center justify-center gap-2">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Keranjang
                        </a>
                    </div>

                    <div class="mt-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border border-emerald-100">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shield-alt text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-emerald-800 mb-1">Pembayaran Aman</p>
                                <p class="text-xs text-emerald-600">Transaksi Anda dilindungi dengan enkripsi Midtrans dan keamanan standar industri</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Checkout -->
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shopping-cart text-5xl text-gray-300"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada Item</h3>
            <p class="text-gray-500 mb-6">Silakan pilih item di keranjang terlebih dahulu</p>
            <a href="{{ route('pembeli.keranjang') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-500/30">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Keranjang
            </a>
        </div>
    @endif

    <!-- Midtrans Snap Script -->
    <script src="{{ env('MIDTRANS_IS_PRODUCTION', false) == 'true' ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        window.openSnap = function() {
            console.log('Opening Midtrans popup with token:', window.snapToken);
            if (typeof snap !== 'undefined' && window.snapToken) {
                snap.pay(window.snapToken, {
                    onSuccess: function(result) {
                        console.log('Payment successful:', result);
                        @this.clearPendingOrder();
                        alert("Pembayaran Berhasil!");
                        window.location.href = '/pesanan';
                    },
                    onPending: function(result) {
                        console.log('Payment pending:', result);
                        alert("Menunggu Pembayaran!");
                        window.location.href = '/pesanan';
                    },
                    onError: function(result) {
                        console.log('Payment error:', result);
                        @this.clearPendingOrder();
                        alert("Pembayaran Gagal!");
                        window.location.href = '/keranjang';
                    },
                    onClose: function() {
                        console.log('Payment popup closed');
                        window.location.href = '/checkout';
                    }
                });
            } else {
                console.error('Snap object or snapToken is not defined');
                alert('Terjadi kesalahan saat memuat pembayaran. Silakan coba lagi.');
            }
        };
    </script>
</div>
