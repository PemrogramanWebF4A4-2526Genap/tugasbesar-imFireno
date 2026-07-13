<div>
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Pesanan Saya</h1>
                <p class="text-gray-500">Kelola dan pantau semua transaksi jasa Anda</p>
            </div>
            <div class="flex gap-3">
                <a wire:navigate href="{{ route('pembeli.home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25">
                    <i class="fas fa-plus"></i>
                    Pesan Jasa Baru
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        @if(count($orders) > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ count($orders) }}</p>
                            <p class="text-xs text-gray-500">Total Pesanan</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $orders->where('status', 'pending')->count() }}</p>
                            <p class="text-xs text-gray-500">Menunggu</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-spinner text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $orders->where('status', 'confirmed')->count() }}</p>
                            <p class="text-xs text-gray-500">Diproses</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-emerald-600"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $orders->whereIn('status', ['completed', 'success'])->count() }}</p>
                            <p class="text-xs text-gray-500">Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if(count($orders) > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300" wire:click="showOrderDetail({{ $order->id }})">
                    <!-- Order Header -->
                    <div class="p-5 border-b border-gray-100 flex flex-wrap gap-4 justify-between items-start">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-receipt text-white text-lg"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <p class="font-bold text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    <span class="text-xs text-gray-400">•</span>
                                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <p class="text-sm text-gray-500">{{ $order->items->count() }} Jasa</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <p class="text-lg font-bold text-emerald-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            @if($order->status == 'success')
                                <span class="px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i> Berhasil
                                </span>
                            @elseif($order->status == 'pending')
                                <span class="px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg text-xs font-semibold">
                                    <i class="fas fa-clock mr-1"></i> Menunggu
                                </span>
                            @elseif($order->status == 'confirmed')
                                <span class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-xs font-semibold">
                                    <i class="fas fa-spinner fa-spin mr-1"></i> Diproses
                                </span>
                            @elseif($order->status == 'completed')
                                <span class="px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i> Selesai
                                </span>
                            @elseif($order->status == 'rejected')
                                <span class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg text-xs font-semibold">
                                    <i class="fas fa-times-circle mr-1"></i> Ditolak
                                </span>
                            @else
                                <span class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-xs font-semibold">
                                    {{ ucfirst($order->status) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Order Items Preview -->
                    <div class="p-5">
                        <div class="flex items-center gap-3">
                            @foreach($order->items->take(3) as $item)
                                <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200">
                                    @if($item->service->thumbnail)
                                        <img src="{{ asset('storage/' . $item->service->thumbnail) }}" alt="{{ $item->service->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-image text-gray-300 text-sm"></i>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            @if($order->items->count() > 3)
                                <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 border border-gray-200">
                                    <span class="text-xs font-semibold text-gray-500">+{{ $order->items->count() - 3 }}</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $order->items->first()->service->name }}</p>
                                <p class="text-xs text-gray-500">Oleh {{ $order->items->first()->service->seller->name }}</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    @if($order->status == 'success' || $order->status == 'confirmed' || $order->status == 'completed')
                        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100 flex items-center gap-2">
                            <a href="{{ route('pembeli.invoice.download', $order->id) }}" 
                               wire:click.stop
                               class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 hover:border-gray-300 transition-all">
                                <i class="fas fa-file-pdf text-red-500"></i>
                                Invoice
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="w-24 h-24 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-box-open text-4xl text-emerald-500"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">Anda belum memiliki pesanan jasa. Mulai cari jasa yang Anda butuhkan dan buat pesanan pertama Anda.</p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a wire:navigate href="{{ route('pembeli.home') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25">
                    <i class="fas fa-search"></i>
                    Cari Jasa
                </a>
                <a wire:navigate href="{{ route('pembeli.kategori') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all">
                    <i class="fas fa-th-large"></i>
                    Lihat Kategori
                </a>
            </div>
        </div>
    @endif

    <!-- Order Detail Modal -->
    @if($showModal && $selectedOrder)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" wire:click.self="closeModal">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="sticky top-0 bg-white border-b border-gray-100 p-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Detail Pesanan</h2>
                        <p class="text-sm text-gray-500">#ORD-{{ str_pad($selectedOrder->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6">
                    <!-- Order Info -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Tanggal Pesanan</p>
                            <p class="font-semibold text-gray-900">{{ $selectedOrder->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Total Belanja</p>
                            <p class="font-bold text-emerald-600">Rp {{ number_format($selectedOrder->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center gap-3">
                        @if($selectedOrder->status == 'success')
                            <span class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold">
                                <i class="fas fa-check-circle mr-1"></i> Berhasil
                            </span>
                        @elseif($selectedOrder->status == 'pending')
                            <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">
                                <i class="fas fa-clock mr-1"></i> Menunggu Konfirmasi Penjual
                            </span>
                        @elseif($selectedOrder->status == 'confirmed')
                            <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                                <i class="fas fa-spinner fa-spin mr-1"></i> Sedang Dikerjakan
                            </span>
                        @elseif($selectedOrder->status == 'completed')
                            <span class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        @elseif($selectedOrder->status == 'rejected')
                            <span class="px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-semibold">
                                <i class="fas fa-times-circle mr-1"></i> Ditolak
                            </span>
                        @else
                            <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold">
                                {{ ucfirst($selectedOrder->status) }}
                            </span>
                        @endif
                    </div>

                    <!-- Job Description -->
                    @if($selectedOrder->job_description)
                        <div class="bg-blue-50 rounded-xl p-4">
                            <div class="flex items-center gap-3 mb-3">
                                <i class="fas fa-edit text-blue-600 text-xl"></i>
                                <div>
                                    <p class="font-semibold text-blue-900">Deskripsi Pekerjaan</p>
                                    <p class="text-sm text-blue-700">Detail pekerjaan yang Anda berikan</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm leading-relaxed">{{ $selectedOrder->job_description }}</p>
                        </div>
                    @endif

                    <!-- Proof of Work -->
                    @if($selectedOrder->proof_of_work)
                        <div class="bg-emerald-50 rounded-xl p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    @if(str_ends_with($selectedOrder->proof_of_work, '.mp4'))
                                        <i class="fas fa-video text-emerald-600 text-xl"></i>
                                    @elseif(str_ends_with($selectedOrder->proof_of_work, '.pdf'))
                                        <i class="fas fa-file-pdf text-emerald-600 text-xl"></i>
                                    @elseif(str_ends_with($selectedOrder->proof_of_work, '.doc') || str_ends_with($selectedOrder->proof_of_work, '.docx'))
                                        <i class="fas fa-file-word text-emerald-600 text-xl"></i>
                                    @elseif(str_ends_with($selectedOrder->proof_of_work, '.xls') || str_ends_with($selectedOrder->proof_of_work, '.xlsx') || str_ends_with($selectedOrder->proof_of_work, '.csv'))
                                        <i class="fas fa-file-excel text-emerald-600 text-xl"></i>
                                    @elseif(str_ends_with($selectedOrder->proof_of_work, '.ppt') || str_ends_with($selectedOrder->proof_of_work, '.pptx'))
                                        <i class="fas fa-file-powerpoint text-emerald-600 text-xl"></i>
                                    @else
                                        <i class="fas fa-file-image text-emerald-600 text-xl"></i>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-emerald-900">Bukti Pengerjaan</p>
                                        <p class="text-sm text-emerald-700">Bukti pengerjaan dari penjual</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $selectedOrder->proof_of_work) }}" 
                                   download
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-semibold hover:bg-emerald-700 transition-colors">
                                    <i class="fas fa-download"></i>
                                    Download
                                </a>
                            </div>
                            @if(str_ends_with($selectedOrder->proof_of_work, '.mp4'))
                                <video controls class="w-full h-auto rounded-lg">
                                    <source src="{{ asset('storage/' . $selectedOrder->proof_of_work) }}" type="video/mp4">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                            @elseif(str_ends_with($selectedOrder->proof_of_work, '.pdf') || str_ends_with($selectedOrder->proof_of_work, '.doc') || str_ends_with($selectedOrder->proof_of_work, '.docx') || str_ends_with($selectedOrder->proof_of_work, '.xls') || str_ends_with($selectedOrder->proof_of_work, '.xlsx') || str_ends_with($selectedOrder->proof_of_work, '.csv') || str_ends_with($selectedOrder->proof_of_work, '.ppt') || str_ends_with($selectedOrder->proof_of_work, '.pptx'))
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <i class="fas fa-file-alt text-4xl text-gray-300 mb-2"></i>
                                    <p class="text-sm text-gray-500">File dokumen - klik tombol download untuk melihat</p>
                                </div>
                            @else
                                <img src="{{ asset('storage/' . $selectedOrder->proof_of_work) }}" class="w-full h-auto rounded-lg cursor-pointer hover:opacity-90 transition-opacity">
                            @endif
                        </div>
                    @endif

                    <!-- Items -->
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-4">Jasa yang Dipesan:</h3>
                        <div class="space-y-4">
                            @foreach($selectedOrder->items as $item)
                                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                    <div class="w-20 h-20 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                                        @if($item->service->thumbnail)
                                            <img src="{{ asset('storage/' . $item->service->thumbnail) }}" alt="{{ $item->service->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i class="fas fa-image text-gray-300 text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-gray-900 truncate">{{ $item->service->name }}</p>
                                        <p class="text-sm text-gray-500">Penjual: {{ $item->service->seller->name }}</p>
                                        <p class="text-sm text-gray-500">Harga: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="sticky bottom-0 bg-white border-t border-gray-100 p-6 space-y-3">
                    @if($selectedOrder->status == 'success' || $selectedOrder->status == 'confirmed' || $selectedOrder->status == 'completed')
                        <div class="flex gap-3">
                            <a href="{{ route('pembeli.invoice.view', $selectedOrder->id) }}" 
                               target="_blank"
                               class="flex items-center justify-center gap-2 flex-1 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-all hover:shadow-lg hover:shadow-blue-500/25">
                                <i class="fas fa-eye"></i>
                                Lihat Invoice
                            </a>
                            <a href="{{ route('pembeli.invoice.download', $selectedOrder->id) }}" 
                               class="flex items-center justify-center gap-2 flex-1 py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25">
                                <i class="fas fa-file-pdf"></i>
                                Download PDF
                            </a>
                        </div>
                    @endif
                    <button wire:click="closeModal" class="w-full py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
