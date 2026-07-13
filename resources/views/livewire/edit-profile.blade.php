<div>
    <!-- Profile Edit Modal -->
    @if($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div wire:click="closeModal" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                <button wire:click="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
                
                <h3 class="text-xl font-bold text-gray-900 mb-4">Edit Profil</h3>
                <p class="text-sm text-gray-500 mb-6">Ubah nama profil Anda di sini.</p>
                
                <form wire:submit="updateProfile">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" wire:model="name" class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 placeholder-gray-400" placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" wire:click="closeModal" class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-all">Batal</button>
                        <button type="submit" class="flex-1 py-3 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Listen for openProfileModal event -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openProfileModal', () => {
                @this.openModal()
            })
        })
    </script>
</div>
