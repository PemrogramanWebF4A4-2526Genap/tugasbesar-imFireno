<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Kategori Jasa</h1>
        <p class="text-gray-500">Temukan jasa berdasarkan kategori yang Anda butuhkan</p>
    </div>

    <div class="grid lg:grid-cols-4 gap-6">
        <!-- Categories Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky top-24">
                <h3 class="font-semibold text-gray-900 mb-4">Semua Kategori</h3>
                <div class="space-y-2">
                    @foreach($categories as $category)
                        <button wire:click="selectCategory({{ $category->id }})"
                                class="w-full text-left px-4 py-3 rounded-xl transition-colors {{ $selectedCategory == $category->id ? 'bg-emerald-600 text-white' : 'bg-gray-50 text-gray-700 hover:bg-gray-100' }}">
                            <div class="flex justify-between items-center">
                                <span class="font-medium">{{ $category->name }}</span>
                                <span class="text-xs {{ $selectedCategory == $category->id ? 'bg-emerald-500' : 'bg-gray-200 text-gray-600' }} px-2 py-1 rounded-full">
                                    {{ $category->services_count }}
                                </span>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="lg:col-span-3">
            @if($selectedCategory)
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Jasa di {{ $categories->find($selectedCategory)->name }}
                    </h2>
                    <p class="text-sm text-gray-500">{{ count($services) }} jasa tersedia</p>
                </div>

                @if(count($services) > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($services as $service)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                                <div class="h-48 bg-gray-100 overflow-hidden">
                                    @if($service->thumbnail)
                                        <img src="{{ asset('storage/' . $service->thumbnail) }}" 
                                             alt="{{ $service->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-image text-gray-300 text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                                        {{ $service->category->name }}
                                    </span>
                                    <h3 class="font-bold text-gray-900 mt-2 mb-1 truncate">{{ $service->name }}</h3>
                                    <p class="text-sm text-gray-500 mb-3 line-clamp-2">{{ $service->description }}</p>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-lg font-bold text-emerald-600">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                                            <p class="text-xs text-gray-400">oleh {{ $service->seller->name }}</p>
                                        </div>
                                        <button wire:click="addToCart({{ $service->id }})" 
                                                class="p-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-box-open text-5xl text-gray-300"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada Jasa</h3>
                        <p class="text-gray-500">Belum ada jasa di kategori ini.</p>
                    </div>
                @endif
            @else
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-list text-5xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Pilih Kategori</h3>
                    <p class="text-gray-500">Silakan pilih kategori untuk melihat jasa yang tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</div>
