<div class="space-y-6">
    <!-- Flash Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Jasa Saya</h1>
            <p class="text-gray-500">Kelola semua jasa yang Anda tawarkan</p>
        </div>
        <a href="{{ route('seller.service.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition-colors">
            <i class="fas fa-plus"></i>
            Tambah Jasa
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input
                        type="text"
                        wire:model.debounce.300ms="search"
                        placeholder="Cari jasa..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    >
                </div>
            </div>

            <!-- Category Filter -->
            <div>
                <select
                    wire:model="categoryFilter"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                >
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <select
                    wire:model="statusFilter"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                >
                    <option value="">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="draft">Draft</option>
                    <option value="inactive">Nonaktif</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <button wire:click="sortBy('name')" class="flex items-center gap-1 hover:text-gray-900">
                                Nama Jasa
                                @if($sortBy === 'name')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <button wire:click="sortBy('price')" class="flex items-center gap-1 hover:text-gray-900">
                                Harga
                                @if($sortBy === 'price')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <button wire:click="sortBy('created_at')" class="flex items-center gap-1 hover:text-gray-900">
                                Tanggal
                                @if($sortBy === 'created_at')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($services as $service)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($service->thumbnail)
                                        <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}" class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $service->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $service->duration }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $service->category->name }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">Rp{{ number_format($service->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 text-sm">
                                    @if($service->service_type === 'online')
                                        <i class="fas fa-globe text-blue-500"></i>
                                        <span class="text-gray-600">Online</span>
                                    @else
                                        <i class="fas fa-map-marker-alt text-red-500"></i>
                                        <span class="text-gray-600">Offline</span>
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($service->status === 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @elseif($service->status === 'draft')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Draft
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $service->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('seller.service.edit', $service->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button wire:click="confirmDelete({{ $service->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <i class="fas fa-box-open text-4xl text-gray-300"></i>
                                    <p class="text-gray-500">Belum ada jasa</p>
                                    <a href="{{ route('seller.service.create') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">
                                        Buat jasa pertama Anda
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($services->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                <p class="text-sm text-gray-500">
                    Menampilkan {{ $services->firstItem() }} sampai {{ $services->lastItem() }} dari {{ $services->total() }} jasa
                </p>
                {{ $services->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    @if($confirmDeleteId)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4 shadow-xl">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Hapus Jasa</h3>
                        <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus jasa ini?</p>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button wire:click="cancelDelete" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button wire:click="deleteService({{ $confirmDeleteId }})" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
