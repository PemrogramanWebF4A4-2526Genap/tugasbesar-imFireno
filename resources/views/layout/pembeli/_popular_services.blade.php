    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Jasa Terpopuler</h2>
                <p class="text-gray-500 mt-4">Pilihan terbaik dari ribuan pengguna JasaMarket minggu ini.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($popularServices as $service)
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:shadow-emerald-900/5 transition-all duration-300 group">
                        <div class="relative overflow-hidden h-56">
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
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($service->seller->name) }}&background=random" class="w-6 h-6 rounded-full">
                                <span class="text-sm text-gray-500 font-medium">{{ $service->seller->name }}</span>
                            </div>
                            <h3 class="font-bold text-xl text-gray-900 mb-2 leading-snug group-hover:text-emerald-600 transition-colors">{{ $service->name }}</h3>
                            
                            <!-- Rating -->
                            @php
                                $avgRating = $service->ratings->avg('rating') ?: 0;
                                $ratingCount = $service->ratings->count();
                            @endphp
                            <div class="flex items-center gap-1 text-amber-400 mb-4 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($avgRating))
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star text-gray-300"></i>
                                    @endif
                                @endfor
                                @if($ratingCount > 0)
                                    <span class="text-gray-700 font-bold ml-1">{{ number_format($avgRating, 1) }}</span>
                                    <span class="text-gray-400 font-normal">({{ $ratingCount }} ulasan)</span>
                                @else
                                    <span class="text-gray-400 font-normal">(Belum ada ulasan)</span>
                                @endif
                            </div>

                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm text-gray-500">Mulai dari</span>
                                <span class="font-bold text-lg text-gray-900">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>