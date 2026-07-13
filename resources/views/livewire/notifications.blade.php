<div>
    <!-- Notification Button -->
    <button wire:click="toggleDropdown" class="relative p-2 hover:bg-gray-50 rounded-full transition-colors">
        <i class="fas fa-bell text-gray-600 text-lg"></i>
        @if($unreadCount > 0)
            <span class="absolute top-1 right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[1.25rem] text-center border border-white">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Notification Dropdown -->
    @if($showDropdown)
        <div class="absolute right-0 top-full mt-2 w-96 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 overflow-hidden">
            <div class="p-4 bg-gray-50/50 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-semibold text-gray-900">Notifikasi</h3>
                @if($unreadCount > 0)
                    <button wire:click="markAllAsRead" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                        Tandai semua dibaca
                    </button>
                @endif
            </div>

            <div class="max-h-96 overflow-y-auto">
                @if(count($notifications) > 0)
                    @foreach($notifications as $notification)
                        <div wire:click="markAsRead({{ $notification->id }})" 
                             class="p-4 border-b border-gray-50 hover:bg-gray-50 cursor-pointer transition-colors {{ $notification->is_read ? 'bg-gray-50/50' : 'bg-white' }}">
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0
                                    @if($notification->type == 'cart_added') bg-blue-100 text-blue-600
                                    @elseif($notification->type == 'checkout_completed') bg-emerald-100 text-emerald-600
                                    @elseif($notification->type == 'order_confirmed') bg-yellow-100 text-yellow-600
                                    @elseif($notification->type == 'order_rejected') bg-red-100 text-red-600
                                    @elseif($notification->type == 'order_completed') bg-purple-100 text-purple-600
                                    @elseif($notification->type == 'new_order') bg-orange-100 text-orange-600
                                    @elseif($notification->type == 'order_paid') bg-teal-100 text-teal-600
                                    @else bg-gray-100 text-gray-600 @endif">
                                    @if($notification->type == 'cart_added')
                                        <i class="fas fa-cart-plus"></i>
                                    @elseif($notification->type == 'checkout_completed')
                                        <i class="fas fa-check-circle"></i>
                                    @elseif($notification->type == 'order_confirmed')
                                        <i class="fas fa-clock"></i>
                                    @elseif($notification->type == 'order_rejected')
                                        <i class="fas fa-times-circle"></i>
                                    @elseif($notification->type == 'order_completed')
                                        <i class="fas fa-check-double"></i>
                                    @elseif($notification->type == 'new_order')
                                        <i class="fas fa-shopping-bag"></i>
                                    @elseif($notification->type == 'order_paid')
                                        <i class="fas fa-money-bill-wave"></i>
                                    @else
                                        <i class="fas fa-bell"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900 text-sm">{{ $notification->title }}</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                                    <p class="text-xs text-gray-400 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                @if(!$notification->is_read)
                                    <div class="w-2 h-2 bg-emerald-500 rounded-full flex-shrink-0"></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-bell-slash text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500">Tidak ada notifikasi</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
