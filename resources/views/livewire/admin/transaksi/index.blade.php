<div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" wire:model="search" placeholder="Cari berdasarkan ID atau nama pembeli..." 
                           class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                </div>
            </div>
            <div class="w-full md:w-64">
                <select wire:model="statusFilter" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="success">Success</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="rejected">Rejected</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">ID Pesanan</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Pembeli</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Jasa</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Total</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-mono text-sm font-semibold text-emerald-600">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name) }}&background=10b981&color=fff" 
                                         class="w-8 h-8 rounded-full">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $order->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    @foreach($order->items as $item)
                                        <p class="text-gray-900 font-medium">{{ $item->service->name }}</p>
                                        <p class="text-gray-500 text-xs">Penjual: {{ $item->service->seller->name }}</p>
                                        @if(!$loop->last)<div class="my-2 border-t border-gray-100"></div>@endif
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($order->status == 'success')
                                    <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm font-semibold">
                                        <i class="fas fa-check-circle mr-1"></i> Berhasil
                                    </span>
                                @elseif($order->status == 'pending')
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                        <i class="fas fa-clock mr-1"></i> Pending
                                    </span>
                                @elseif($order->status == 'confirmed')
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                                        <i class="fas fa-spinner fa-spin mr-1"></i> Dikonfirmasi
                                    </span>
                                @elseif($order->status == 'completed')
                                    <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm font-semibold">
                                        <i class="fas fa-check-circle mr-1"></i> Selesai
                                    </span>
                                @elseif($order->status == 'rejected')
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                        <i class="fas fa-times-circle mr-1"></i> Ditolak
                                    </span>
                                @elseif($order->status == 'failed')
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                        <i class="fas fa-times-circle mr-1"></i> Gagal
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm font-semibold">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4 text-gray-300"></i>
                                <p>Tidak ada transaksi ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-500">
                    Menampilkan {{ $orders->firstItem() }} - {{ $orders->lastItem() }} dari {{ $orders->total() }} transaksi
                </p>
                <div class="flex items-center gap-2">
                    @if($orders->onFirstPage())
                        <button disabled class="px-3 py-2 text-sm text-gray-400 bg-gray-50 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    @else
                        <button wire:click="previousPage" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    @endif

                    @foreach($orders->getUrlRange(1, $orders->lastPage()) as $url => $page)
                        @if($page == $orders->currentPage())
                            <button class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg">
                                {{ $page }}
                            </button>
                        @elseif($page == '...')
                            <span class="px-3 py-2 text-sm text-gray-500">...</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach

                    @if($orders->hasMorePages())
                        <button wire:click="nextPage" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @else
                        <button disabled class="px-3 py-2 text-sm text-gray-400 bg-gray-50 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
