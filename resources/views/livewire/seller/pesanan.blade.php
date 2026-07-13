<div>
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Pesanan Masuk</h1>
                <p class="text-gray-500">Kelola dan pantau semua pesanan jasa yang masuk</p>
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
                            <p class="text-2xl font-bold text-gray-900">{{ $orders->where('status', 'completed')->count() }}</p>
                            <p class="text-xs text-gray-500">Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Status Filter -->
    <div class="mb-6 bg-white rounded-xl p-2 border border-gray-100 shadow-sm inline-flex gap-1">
        <button wire:click="setStatusFilter('all')" 
                class="px-4 py-2 rounded-lg font-medium transition-colors {{ $statusFilter === 'all' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
            Semua
        </button>
        <button wire:click="setStatusFilter('pending')" 
                class="px-4 py-2 rounded-lg font-medium transition-colors {{ $statusFilter === 'pending' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
            Menunggu
        </button>
        <button wire:click="setStatusFilter('confirmed')" 
                class="px-4 py-2 rounded-lg font-medium transition-colors {{ $statusFilter === 'confirmed' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
            Diproses
        </button>
        <button wire:click="setStatusFilter('completed')" 
                class="px-4 py-2 rounded-lg font-medium transition-colors {{ $statusFilter === 'completed' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
            Selesai
        </button>
        <button wire:click="setStatusFilter('rejected')" 
                class="px-4 py-2 rounded-lg font-medium transition-colors {{ $statusFilter === 'rejected' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
            Ditolak
        </button>
    </div>

    @if(count($orders) > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 cursor-pointer" wire:click="showOrderDetail({{ $order->id }})">
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
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name) }}&background=10b981&color=fff" 
                                         class="w-6 h-6 rounded-full">
                                    <p class="text-sm text-gray-500">{{ $order->user->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <p class="text-lg font-bold text-emerald-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            @if($order->status == 'pending')
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
                                @if($item->service->seller_id == auth()->id())
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200">
                                        @if($item->service->thumbnail)
                                            <img src="{{ asset('storage/' . $item->service->thumbnail) }}" alt="{{ $item->service->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i class="fas fa-image text-gray-300 text-sm"></i>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                            <div class="flex-1">
                                @php
                                    $sellerItems = $order->items->filter(function($item) {
                                        return $item->service->seller_id == auth()->id();
                                    });
                                @endphp
                                @if($sellerItems->count() > 0)
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $sellerItems->first()->service->name }}</p>
                                    <p class="text-xs text-gray-500">Rp {{ number_format($sellerItems->first()->price, 0, ',', '.') }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Job Description Preview -->
                        @if($order->job_description)
                            <div class="mt-4 bg-blue-50 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="fas fa-edit text-blue-600 text-sm"></i>
                                    <p class="text-xs font-semibold text-blue-900">Deskripsi Pekerjaan</p>
                                </div>
                                <p class="text-xs text-gray-700 line-clamp-2">{{ Str::limit($order->job_description, 100) }}</p>
                            </div>
                        @endif

                        <!-- Proof of Work Preview -->
                        @if($order->proof_of_work)
                            <div class="mt-4 bg-emerald-50 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-2">
                                    @if(str_ends_with($order->proof_of_work, '.mp4'))
                                        <i class="fas fa-video text-emerald-600 text-sm"></i>
                                    @else
                                        <i class="fas fa-file-image text-emerald-600 text-sm"></i>
                                    @endif
                                    <p class="text-xs font-semibold text-emerald-900">Bukti Pengerjaan</p>
                                </div>
                                @if(str_ends_with($order->proof_of_work, '.mp4'))
                                    <video controls class="w-full h-32 object-cover rounded-lg">
                                        <source src="{{ asset('storage/' . $order->proof_of_work) }}" type="video/mp4">
                                    </video>
                                @else
                                    <img src="{{ asset('storage/' . $order->proof_of_work) }}" class="w-full h-32 object-cover rounded-lg">
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-5 py-3 bg-gray-50 border-t border-gray-100 flex items-center gap-2" wire:click.stop>
                        @if($order->status == 'pending')
                            <button wire:click="confirmOrder({{ $order->id }})" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition-all">
                                <i class="fas fa-check"></i>
                                Konfirmasi
                            </button>
                            <button wire:click="rejectOrder({{ $order->id }})" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-red-50 hover:border-red-200 hover:text-red-600 transition-all">
                                <i class="fas fa-times"></i>
                                Tolak
                            </button>
                        @elseif($order->status == 'confirmed')
                            @if($order->proof_of_work)
                                <button wire:click="completeOrder({{ $order->id }})" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition-all">
                                    <i class="fas fa-check-circle"></i>
                                    Selesai
                                </button>
                                <button wire:click="deleteProofOfWork({{ $order->id }})" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-red-50 hover:border-red-200 hover:text-red-600 transition-all">
                                    <i class="fas fa-trash"></i>
                                    Hapus Bukti
                                </button>
                            @else
                                <button wire:click="openProofUpload({{ $order->id }})" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all">
                                    <i class="fas fa-upload"></i>
                                    Upload Bukti
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="w-24 h-24 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-inbox text-4xl text-emerald-500"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">Belum ada pesanan yang masuk untuk jasa Anda. Pastikan jasa Anda aktif dan menarik untuk mendapatkan pesanan.</p>
            <a wire:navigate href="{{ route('seller.jasa') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25">
                <i class="fas fa-plus"></i>
                Kelola Jasa
            </a>
        </div>
    @endif

    <!-- Proof Upload Modal -->
    @if($selectedOrderId)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div wire:click="closeProofUpload" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                <button wire:click="closeProofUpload" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
                
                <h3 class="text-xl font-bold text-gray-900 mb-4">Upload Bukti Pengerjaan</h3>
                <p class="text-sm text-gray-500 mb-6">Upload foto atau file sebagai bukti pengerjaan untuk ditunjukkan ke pembeli.</p>
                
                <form wire:submit="uploadProofOfWork({{ $selectedOrderId }})">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Bukti Pengerjaan</label>
                        <input type="file" wire:model="proofOfWork" accept="image/*,video/mp4,.pdf,.doc,.docx,.xls,.xlsx,.csv,.ppt,.pptx" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        @error('proofOfWork')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-400 mt-1">Format: PNG, JPG, GIF, MP4, PDF, DOC, DOCX, XLS, XLSX, CSV, PPT, PPTX (Max 10MB)</p>
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" wire:click="closeProofUpload" class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-colors">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Order Detail Modal -->
    @if($showDetailModal && $selectedOrder)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" wire:click.self="closeDetailModal">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="sticky top-0 bg-white border-b border-gray-100 p-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Detail Pesanan</h2>
                        <p class="text-sm text-gray-500">#ORD-{{ str_pad($selectedOrder->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <button wire:click="closeDetailModal" class="text-gray-400 hover:text-gray-600 transition-colors">
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

                    <!-- Buyer Info -->
                    <div class="bg-blue-50 rounded-xl p-4">
                        <div class="flex items-center gap-3 mb-3">
                            <i class="fas fa-user text-blue-600 text-xl"></i>
                            <div>
                                <p class="font-semibold text-blue-900">Informasi Pembeli</p>
                                <p class="text-sm text-blue-700">Detail pembeli yang memesan</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($selectedOrder->user->name) }}&background=10b981&color=fff" 
                                 class="w-12 h-12 rounded-full">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $selectedOrder->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $selectedOrder->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center gap-3">
                        @if($selectedOrder->status == 'pending')
                            <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">
                                <i class="fas fa-clock mr-1"></i> Menunggu Konfirmasi
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
                                    <p class="text-sm text-blue-700">Detail pekerjaan dari pembeli</p>
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
                                        <p class="text-sm text-emerald-700">Bukti pengerjaan yang telah diupload</p>
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
                                @if($item->service->seller_id == auth()->id())
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
                                            <p class="text-sm text-gray-500">Harga: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="sticky bottom-0 bg-white border-t border-gray-100 p-6 space-y-3" wire:click.stop>
                    @if($selectedOrder->status == 'pending')
                        <div class="flex gap-3">
                            <button wire:click="confirmOrder({{ $selectedOrder->id }})" class="flex-1 py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-colors">
                                <i class="fas fa-check mr-2"></i> Konfirmasi Pesanan
                            </button>
                            <button wire:click="rejectOrder({{ $selectedOrder->id }})" class="flex-1 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition-colors">
                                <i class="fas fa-times mr-2"></i> Tolak Pesanan
                            </button>
                        </div>
                    @elseif($selectedOrder->status == 'confirmed')
                        @if($selectedOrder->proof_of_work)
                            <button wire:click="completeOrder({{ $selectedOrder->id }})" class="w-full py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-colors">
                                <i class="fas fa-check-circle mr-2"></i> Tandai Selesai
                            </button>
                        @else
                            <button wire:click="openProofUpload({{ $selectedOrder->id }})" class="w-full py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                <i class="fas fa-upload mr-2"></i> Upload Bukti Pengerjaan
                            </button>
                        @endif
                    @endif
                    <button wire:click="closeDetailModal" class="w-full py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
