<div>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Laporan Penjualan</h1>
        <p class="text-gray-500 mt-1">Ringkasan pendapatan dan riwayat penjualan jasa Anda.</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-2xl">
                <i class="fas fa-wallet"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Total Pendapatan</p>
                <h3 class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Jasa Terjual (Berhasil)</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $totalPesananSelesai }} Pesanan</h3>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="font-bold text-gray-900 text-lg">Riwayat Transaksi</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="py-4 px-6 font-semibold text-sm text-gray-600 border-b border-gray-100">Tanggal</th>
                        <th class="py-4 px-6 font-semibold text-sm text-gray-600 border-b border-gray-100">Order ID</th>
                        <th class="py-4 px-6 font-semibold text-sm text-gray-600 border-b border-gray-100">Jasa</th>
                        <th class="py-4 px-6 font-semibold text-sm text-gray-600 border-b border-gray-100">Harga</th>
                        <th class="py-4 px-6 font-semibold text-sm text-gray-600 border-b border-gray-100">Status Pesanan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orderItems as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 text-sm text-gray-600">
                                {{ $item->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900">
                                #{{ $item->order_id }}
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-700">
                                {{ $item->service->name }}
                            </td>
                            <td class="py-4 px-6 text-sm font-bold text-emerald-600">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6">
                                @if($item->order->status == 'PAID' || $item->order->status == 'COMPLETED')
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-semibold border border-emerald-100">Berhasil</span>
                                @elseif($item->order->status == 'PENDING' || $item->order->status == 'UNPAID')
                                    <span class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded-full text-xs font-semibold border border-yellow-100">Menunggu</span>
                                @else
                                    <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-semibold border border-red-100">{{ $item->order->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                    <p>Belum ada data penjualan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
