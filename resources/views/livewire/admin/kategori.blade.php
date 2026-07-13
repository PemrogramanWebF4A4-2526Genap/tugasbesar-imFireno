<div>
    <!-- Header Actions -->
    <div class="mb-6 flex justify-between items-center">
        <div class="text-sm text-gray-500">
            Total {{ count($categories) }} kategori
        </div>
        <button wire:click="openCreateModal" class="px-4 py-2 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors">
            <i class="fas fa-plus mr-2"></i> Tambah Kategori
        </button>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-700">Nama Kategori</th>
                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-700">Deskripsi</th>
                    <th class="text-center px-6 py-4 text-sm font-semibold text-gray-700">Jumlah Jasa</th>
                    <th class="text-center px-6 py-4 text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(count($categories) > 0)
                    @foreach($categories as $category)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-900">{{ $category->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600">{{ $category->description ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    {{ $category->services_count }} jasa
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button wire:click="openEditModal({{ $category->id }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="openDeleteModal({{ $category->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-folder-open text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-gray-500">Belum ada kategori</p>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div wire:click="closeModals" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6">
                <button wire:click="closeModals" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
                
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ $editingId ? 'Edit Kategori' : 'Tambah Kategori' }}
                </h3>
                
                <form wire:submit="save">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                        <input type="text" wire:model="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Contoh: Desain Grafis">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea wire:model="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Deskripsi singkat tentang kategori"></textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" wire:click="closeModals" class="flex-1 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 py-2.5 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                            {{ $editingId ? 'Simpan Perubahan' : 'Tambah Kategori' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div wire:click="closeModals" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Kategori</h3>
                    <p class="text-gray-500 mb-6">Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan.</p>
                    
                    <div class="flex gap-3">
                        <button wire:click="closeModals" class="flex-1 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                            Batal
                        </button>
                        <button wire:click="delete" class="flex-1 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
