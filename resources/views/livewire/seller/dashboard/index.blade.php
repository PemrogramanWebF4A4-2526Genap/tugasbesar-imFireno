<div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-emerald-600 text-xl"></i>
                </div>
                <span class="text-sm text-gray-500">Total Pesanan</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
            <p class="text-sm text-gray-500 mt-1">Semua status</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-wallet text-blue-600 text-xl"></i>
                </div>
                <span class="text-sm text-gray-500">Total Pendapatan</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500 mt-1">Dari pesanan selesai</p>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <span class="text-sm text-gray-500">Menunggu Konfirmasi</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $recentOrders->where('status', 'pending')->count() }}</p>
            <p class="text-sm text-gray-500 mt-1">Perlu tindakan</p>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-lg text-gray-900">Pesanan Terbaru</h3>
            <a href="{{ route('seller.pesanan') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        @if(count($recentOrders) > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">ID Pesanan</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Pelanggan</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Jasa</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Total</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <span class="font-medium text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name) }}&background=random" class="w-8 h-8 rounded-full">
                                        <span class="text-gray-900">{{ $order->user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    @foreach($order->items as $item)
                                        @if($item->service->seller_id == auth()->id())
                                            <span class="text-gray-600 text-sm">{{ $item->service->name }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="py-4 px-4">
                                    @if($order->status == 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Menunggu Konfirmasi
                                        </span>
                                    @elseif($order->status == 'confirmed')
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Dikonfirmasi
                                        </span>
                                    @elseif($order->status == 'completed')
                                        <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Selesai
                                        </span>
                                    @elseif($order->status == 'rejected')
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4">
                                    <span class="font-semibold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-inbox text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-500">Belum ada pesanan yang masuk untuk jasa Anda.</p>
            </div>
        @endif
    </div>
</div>
