<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Jasa</h1>
        <p class="text-gray-500">Perbarui informasi jasa Anda</p>
    </div>

    <!-- Form -->
    <form wire:submit="update" class="space-y-6">
        <!-- Basic Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jasa <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        wire:model="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        placeholder="Masukkan nama jasa"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select
                        wire:model="category_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    >
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input
                        type="number"
                        wire:model="price"
                        min="0"
                        step="0.01"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        placeholder="0"
                    >
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estimasi Pengerjaan <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        wire:model="duration"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        placeholder="Contoh: 3 hari, 1 minggu"
                    >
                    @error('duration')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Revision -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Revisi <span class="text-red-500">*</span></label>
                    <input
                        type="number"
                        wire:model="revision"
                        min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        placeholder="0"
                    >
                    @error('revision')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Service Type & Location -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Tipe Jasa</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Service Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Jasa <span class="text-red-500">*</span></label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" wire:model="service_type" value="online" class="text-emerald-600 focus:ring-emerald-500">
                            <span>Online</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" wire:model="service_type" value="offline" class="text-emerald-600 focus:ring-emerald-500">
                            <span>Offline</span>
                        </label>
                    </div>
                    @error('service_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location (only for offline) -->
                @if($service_type === 'offline')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            wire:model="location"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                            placeholder="Masukkan lokasi"
                        >
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            </div>
        </div>

        <!-- Description -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi</h2>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Jasa <span class="text-red-500">*</span></label>
                <textarea
                    wire:model="description"
                    rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    placeholder="Jelaskan detail jasa yang Anda tawarkan"
                ></textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Thumbnail -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Thumbnail</h2>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Thumbnail</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-emerald-500 transition-colors">
                    @if($thumbnail)
                        <div class="relative inline-block">
                            <img src="{{ $thumbnail->temporaryUrl() }}" alt="Preview" class="max-h-48 rounded-lg mx-auto">
                            <button
                                type="button"
                                wire:click="$set('thumbnail', null)"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @elseif($existingThumbnail)
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/' . $existingThumbnail) }}" alt="Existing" class="max-h-48 rounded-lg mx-auto">
                        </div>
                    @else
                        <div>
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-500 mb-2">Klik untuk upload atau drag & drop</p>
                            <p class="text-sm text-gray-400">JPG, JPEG, PNG, WEBP (Max 2MB)</p>
                        </div>
                    @endif
                    <input
                        type="file"
                        wire:model="thumbnail"
                        accept="image/jpeg,image/jpg,image/png,image/webp"
                        class="hidden"
                        id="thumbnail-upload"
                    >
                    <label for="thumbnail-upload" class="cursor-pointer">
                        @if(!$thumbnail)
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 mt-4">
                                <i class="fas fa-upload"></i>
                                {{ $existingThumbnail ? 'Ganti Thumbnail' : 'Pilih File' }}
                            </span>
                        @endif
                    </label>
                </div>
                @error('thumbnail')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Status</h2>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Jasa <span class="text-red-500">*</span></label>
                <select
                    wire:model="status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                >
                    <option value="draft">Draft</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('seller.service.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                Perbarui Jasa
            </button>
        </div>
    </form>
</div>
