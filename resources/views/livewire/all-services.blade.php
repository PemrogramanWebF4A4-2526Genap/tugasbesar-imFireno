<div>
    <!-- Search and Filter Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="text" 
                        wire:model.live="search" 
                        placeholder="Cari jasa..." 
                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all"
                    >
                </div>
            </div>
            
            <!-- Category Filter -->
            <div class="md:w-64">
                <select 
                    wire:model.live="categoryFilter" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all cursor-pointer"
                >
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Sort -->
            <div class="md:w-48">
                <select 
                    wire:model="sortBy" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all cursor-pointer"
                >
                    <option value="created_at">Terbaru</option>
                    <option value="price_asc">Harga Terendah</option>
                    <option value="price_desc">Harga Tertinggi</option>
                    <option value="name">Nama A-Z</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    @if($services->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:shadow-emerald-900/5 transition-all duration-300 group">
                    <!-- Thumbnail -->
                    <div class="relative overflow-hidden h-48">
                        @if($service->thumbnail)
                            <img src="{{ asset('storage/' . $service->thumbnail) }}" 
                                 alt="{{ $service->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                                <i class="fas fa-image text-emerald-400 text-4xl"></i>
                            </div>
                        @endif
                        
                        @if($service->category)
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-emerald-600">
                                {{ $service->category->name }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-5">
                        <!-- Seller Info -->
                        <div class="flex items-center gap-2 mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($service->seller->name) }}&background=random" 
                                 class="w-8 h-8 rounded-full">
                            <span class="text-sm text-gray-500 font-medium">{{ $service->seller->name }}</span>
                        </div>
                        
                        <!-- Service Name -->
                        <h3 class="font-bold text-lg text-gray-900 mb-2 leading-snug group-hover:text-emerald-600 transition-colors">
                            {{ $service->name }}
                        </h3>
                        
                        <!-- Rating -->
                        <div class="flex items-center gap-1 mb-2">
                            @php
                                $avgRating = $service->ratings->avg('rating') ?: 0;
                                $ratingCount = $service->ratings->count();
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($avgRating))
                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                @else
                                    <i class="far fa-star text-gray-300 text-sm"></i>
                                @endif
                            @endfor
                            @if($ratingCount > 0)
                                <span class="text-xs text-gray-500">({{ number_format($avgRating, 1) }}, {{ $ratingCount }})</span>
                            @else
                                <span class="text-xs text-gray-500">(Belum ada rating)</span>
                            @endif
                        </div>
                        
                        <!-- Description -->
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">
                            {{ Str::limit($service->description, 100) }}
                        </p>
                        
                        <!-- Duration -->
                        @if($service->duration)
                            <div class="flex items-center gap-2 text-sm text-gray-400 mb-4">
                                <i class="fas fa-clock"></i>
                                <span>{{ $service->duration }}</span>
                            </div>
                        @endif
                        
                        <!-- Price and Action -->
                        <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500">Mulai dari</p>
                                <p class="font-bold text-lg text-gray-900">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                            </div>
                            <button wire:click="showServiceDetail({{ $service->id }})" class="px-4 py-2 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-colors text-sm">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $services->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-search text-4xl text-gray-300"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada jasa ditemukan</h3>
            <p class="text-gray-500">Coba kata kunci atau filter lain</p>
        </div>
    @endif

    <!-- Service Detail Modal -->
    @if($showModal && $selectedService)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <!-- Backdrop with blur -->
            <div wire:click="closeModal" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>
            
            <!-- Modal Content -->
            <div class="relative w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden animate-modal-in max-h-[90vh] flex flex-col">
                <!-- Close Button -->
                <button wire:click="closeModal" class="absolute top-4 right-4 z-10 w-10 h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 hover:bg-white transition-all shadow-lg">
                    <i class="fas fa-times"></i>
                </button>

                <!-- Two Column Layout -->
                <div class="flex flex-col lg:flex-row flex-1 overflow-y-auto lg:overflow-hidden">
                    
                    <!-- LEFT COLUMN: Thumbnail, Info, Description, Revision -->
                    <div class="lg:w-3/5 flex-shrink-0 lg:overflow-y-auto">
                        <!-- Header Image -->
                        <div class="relative h-48 lg:h-64 bg-gradient-to-br from-emerald-100 to-teal-100">
                            @if($selectedService->thumbnail)
                                <img src="{{ asset('storage/' . $selectedService->thumbnail) }}" 
                                     alt="{{ $selectedService->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-emerald-300 text-5xl lg:text-6xl"></i>
                                </div>
                            @endif
                            
                            <!-- Category Badge -->
                            @if($selectedService->category)
                                <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur px-3 lg:px-4 py-1.5 lg:py-2 rounded-full text-xs lg:text-sm font-bold text-emerald-600 shadow-lg">
                                    {{ $selectedService->category->name }}
                                </div>
                            @endif
                        </div>

                        <!-- Left Content -->
                        <div class="p-5 lg:p-8">
                            <!-- Seller Info -->
                            <div class="flex items-center gap-3 lg:gap-4 mb-5 lg:mb-6 pb-5 lg:pb-6 border-b border-gray-100">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($selectedService->seller->name) }}&background=10b981&color=fff" 
                                     class="w-12 h-12 lg:w-14 lg:h-14 rounded-full shadow-md">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm lg:text-base">{{ $selectedService->seller->name }}</h3>
                                    <p class="text-xs lg:text-sm text-gray-500">Penjual Terpercaya</p>
                                </div>
                            </div>

                            <!-- Service Name & Price -->
                            <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-4 mb-6">
                                <div class="flex-1">
                                    <h2 class="text-xl lg:text-2xl font-bold text-gray-900 mb-2">{{ $selectedService->name }}</h2>
                                    
                                    <!-- Rating Summary (small) -->
                                    @php
                                        $avgRating = $selectedService->ratings->avg('rating') ?: 0;
                                        $ratingCount = $selectedService->ratings->count();
                                    @endphp
                                    <div class="flex items-center gap-1.5 lg:gap-2 mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($avgRating))
                                                <i class="fas fa-star text-yellow-400 text-sm lg:text-base"></i>
                                            @else
                                                <i class="far fa-star text-gray-300 text-sm lg:text-base"></i>
                                            @endif
                                        @endfor
                                        @if($ratingCount > 0)
                                            <span class="text-xs lg:text-sm text-gray-500">{{ number_format($avgRating, 1) }} ({{ $ratingCount }} ulasan)</span>
                                        @else
                                            <span class="text-xs lg:text-sm text-gray-500">(Belum ada ulasan)</span>
                                        @endif
                                    </div>
                                    
                                    @if($selectedService->duration)
                                        <div class="flex items-center gap-2 text-sm lg:text-base text-gray-500">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $selectedService->duration }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="lg:text-right bg-emerald-50 lg:bg-transparent p-4 lg:p-0 rounded-xl lg:rounded-none">
                                    <p class="text-xs lg:text-sm text-emerald-700 lg:text-gray-500 mb-1 lg:mb-0 font-medium lg:font-normal">Harga</p>
                                    <p class="text-xl lg:text-2xl font-bold text-emerald-600">Rp {{ number_format($selectedService->price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-900 mb-2 lg:mb-3 text-sm lg:text-base">Deskripsi</h3>
                                <p class="text-sm lg:text-base text-gray-600 leading-relaxed">{{ $selectedService->description }}</p>
                            </div>

                            <!-- Service Type -->
                            @if($selectedService->service_type)
                                <div class="mb-6">
                                    <h3 class="font-semibold text-gray-900 mb-2 lg:mb-3 text-sm lg:text-base">Tipe Jasa</h3>
                                    <div class="inline-flex items-center gap-2 px-3 lg:px-4 py-1.5 lg:py-2 bg-emerald-50 text-emerald-700 rounded-full text-xs lg:text-sm font-medium">
                                        <i class="fas fa-tag"></i>
                                        {{ $selectedService->service_type }}
                                    </div>
                                </div>
                            @endif

                            <!-- Location -->
                            @if($selectedService->location)
                                <div class="mb-6">
                                    <h3 class="font-semibold text-gray-900 mb-2 lg:mb-3 text-sm lg:text-base">Lokasi</h3>
                                    <div class="flex items-center gap-2 text-sm lg:text-base text-gray-600">
                                        <i class="fas fa-map-marker-alt text-emerald-500"></i>
                                        <span>{{ $selectedService->location }}</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Revision -->
                            @if($selectedService->revision)
                                <div class="mb-6">
                                    <h3 class="font-semibold text-gray-900 mb-2 lg:mb-3 text-sm lg:text-base">Revisi</h3>
                                    <div class="flex items-center gap-2 text-sm lg:text-base text-gray-600">
                                        <i class="fas fa-redo text-emerald-500"></i>
                                        <span>{{ $selectedService->revision }} kali revisi</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex flex-col-reverse sm:flex-row gap-3 lg:gap-4 pt-4 border-t border-gray-100">
                                <button wire:click="closeModal" class="w-full sm:flex-1 py-3 lg:py-3.5 border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors text-sm lg:text-base">
                                    Tutup
                                </button>
                                <button wire:click="addToCart({{ $selectedService->id }})" class="w-full sm:flex-1 py-3 lg:py-3.5 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25 flex items-center justify-center gap-2 text-sm lg:text-base">
                                    <i class="fas fa-shopping-cart"></i>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: Rating Section -->
                    <div class="lg:w-2/5 border-t lg:border-t-0 lg:border-l border-gray-100 bg-gray-50/30 lg:overflow-y-auto custom-scrollbar">
                        <div class="p-5 lg:p-8 h-full flex flex-col">
                            <!-- Rating Header -->
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold text-gray-900">Ulasan & Rating</h3>
                                @if(auth()->check())
                                    <button wire:click="$set('showRatingForm', true)" class="text-sm px-4 py-2 bg-emerald-50 text-emerald-600 rounded-full hover:bg-emerald-100 font-medium transition-colors flex items-center gap-2">
                                        <i class="fas fa-star"></i> Beri Rating
                                    </button>
                                @endif
                            </div>

                            <!-- Rating Overview -->
                            @php
                                $avgRating = $selectedService->ratings->avg('rating') ?: 0;
                                $ratingCount = $selectedService->ratings->count();
                            @endphp
                            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 mb-6 text-center shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 relative overflow-hidden">
                                <!-- Decorative background element -->
                                <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full opacity-50 blur-xl"></div>
                                <div class="absolute -left-6 -bottom-6 w-24 h-24 bg-yellow-50 rounded-full opacity-50 blur-xl"></div>
                                
                                <div class="relative z-10">
                                    <div class="text-5xl font-extrabold text-gray-900 mb-2 tracking-tight">{{ number_format($avgRating, 1) }}</div>
                                    <div class="flex items-center justify-center gap-1.5 mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($avgRating))
                                                <i class="fas fa-star text-yellow-400 text-xl drop-shadow-sm"></i>
                                            @else
                                                <i class="far fa-star text-gray-200 text-xl"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-sm font-medium text-gray-500">{{ $ratingCount }} ulasan dari pembeli</p>
                                </div>
                            </div>

                            <!-- Rating Form -->
                            @if($showRatingForm && auth()->check())
                                <div class="bg-white rounded-2xl p-6 mb-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 animate-modal-in">
                                    <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-50">
                                        <h4 class="font-semibold text-gray-900">Tulis Ulasan Anda</h4>
                                        <button wire:click="$set('showRatingForm', false)" class="text-gray-400 hover:text-gray-600 transition-colors">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <form wire:submit="submitRating">
                                        <!-- Star Rating -->
                                        <div class="mb-5">
                                            <label class="block text-sm font-medium text-gray-700 mb-3">Seberapa puas Anda?</label>
                                            <div class="flex gap-2 justify-center py-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <button type="button" 
                                                        wire:click="$set('rating', {{ $i }})"
                                                        class="text-3xl {{ $i <= $rating ? 'text-yellow-400 scale-110' : 'text-gray-200 hover:text-yellow-200' }} transition-all transform hover:scale-110 focus:outline-none">
                                                        <i class="fas fa-star"></i>
                                                    </button>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- Comment -->
                                        <div class="mb-5">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Ceritakan pengalaman Anda</label>
                                            <textarea wire:model="comment" 
                                                rows="3" 
                                                placeholder="Apakah hasil kerjanya memuaskan? Sesuai ekspektasi?"
                                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white outline-none resize-none transition-all text-sm"></textarea>
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Tambah Foto (Opsional)</label>
                                            <div class="relative border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-emerald-400 hover:bg-emerald-50/50 transition-colors cursor-pointer group">
                                                <input type="file" wire:model="ratingImage" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                                <div class="text-gray-400 group-hover:text-emerald-500 transition-colors">
                                                    <i class="fas fa-cloud-upload-alt text-2xl mb-2"></i>
                                                    <p class="text-xs font-medium">Klik atau drop gambar di sini</p>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="w-full py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-500/30 transition-all focus:ring-4 focus:ring-emerald-500/20">
                                            Kirim Ulasan
                                        </button>
                                    </form>
                                </div>
                            @endif

                            <!-- Existing Ratings -->
                            <div class="flex-1 min-h-0">
                                @if($selectedService->ratings->count() > 0)
                                    <div class="space-y-4 pr-2">
                                        @foreach($selectedService->ratings->take(5) as $rating)
                                            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                                <div class="flex items-start gap-4">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($rating->user->name) }}&background=f3f4f6&color=374151" 
                                                         class="w-11 h-11 rounded-full border border-gray-100">
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-center justify-between mb-0.5">
                                                            <span class="font-bold text-gray-900 text-sm truncate">{{ $rating->user->name }}</span>
                                                            <span class="text-xs text-gray-400">{{ $rating->created_at ? $rating->created_at->diffForHumans() : '' }}</span>
                                                        </div>
                                                        <div class="flex gap-0.5 mb-3">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= $rating->rating)
                                                                    <i class="fas fa-star text-yellow-400 text-[10px]"></i>
                                                                @else
                                                                    <i class="far fa-star text-gray-200 text-[10px]"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        @if($rating->comment)
                                                            <p class="text-sm text-gray-600 leading-relaxed">{{ $rating->comment }}</p>
                                                        @endif
                                                        @if($rating->image)
                                                            <div class="mt-3">
                                                                <img src="{{ asset('storage/' . $rating->image) }}" class="w-24 h-24 rounded-xl object-cover border border-gray-100 cursor-pointer hover:opacity-90 transition-opacity">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="h-full flex flex-col items-center justify-center text-center py-10 opacity-70">
                                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-star-half-alt text-gray-300 text-3xl"></i>
                                        </div>
                                        <h4 class="font-semibold text-gray-700 mb-1">Belum Ada Ulasan</h4>
                                        <p class="text-sm text-gray-500 max-w-[200px]">Jadilah yang pertama memberikan ulasan untuk jasa ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif

    <style>
        @keyframes modal-in {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        .animate-modal-in {
            animation: modal-in 0.3s ease-out;
        }
    </style>
</div>
