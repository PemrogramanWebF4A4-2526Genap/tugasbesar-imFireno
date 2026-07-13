<div>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Users -->
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 shadow-lg shadow-emerald-500/20 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium mb-1">Total Users</p>
                    <h3 class="text-3xl font-bold">{{ $totalUsers }}</h3>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Sellers -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 shadow-lg shadow-orange-500/20 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium mb-1">Total Penjual</p>
                    <h3 class="text-3xl font-bold">{{ $totalSellers }}</h3>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-store text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Buyers -->
        <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl p-6 shadow-lg shadow-cyan-500/20 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-cyan-100 text-sm font-medium mb-1">Total Pembeli</p>
                    <h3 class="text-3xl font-bold">{{ $totalBuyers }}</h3>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-shopping-bag text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Admins -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 shadow-lg shadow-purple-500/20 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">Total Admin</p>
                    <h3 class="text-3xl font-bold">{{ $totalAdmins }}</h3>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-user-shield text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex justify-between mb-4">
            <h3 class="font-bold text-lg">
                Daftar User
            </h3>
            <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Tambah User
            </button>
        </div>

        @if($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $user_id ? 'Edit User' : 'Tambah User' }}</h2>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form wire:submit.prevent="store" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" wire:model="name" class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 placeholder-gray-400" placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" wire:model="email" class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 placeholder-gray-400" placeholder="nama@email.com">
                        </div>
                        @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password {{ $user_id ? '(Kosongkan jika tidak ingin mengubah)' : '' }}</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="password" wire:model="password" class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 placeholder-gray-400" placeholder="••••••••">
                        </div>
                        @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <div class="relative">
                            <i class="fas fa-user-tag absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <select wire:model="role" class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 appearance-none cursor-pointer">
                                <option value="admin">Admin</option>
                                <option value="pembeli">Pembeli</option>
                                <option value="penjual">Penjual</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                        @error('role') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" wire:click="closeModal" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-all">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-3">No</th>
                    <th class="text-left py-3">Name</th>
                    <th class="text-left py-3">Email</th>
                    <th class="text-left py-3">Role</th>
                    <th class="text-left py-3">Status</th>
                    <th class="text-left py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    <tr>
                        <td class="py-4">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        
                        @if ($item->role == 'admin')
                            <td class="text-purple-500">{{ $item->role }}</td>
                        @elseif ($item->role == 'pembeli')
                            <td class="text-cyan-400">{{ $item->role }}</td>
                        @elseif ($item->role == 'penjual')
                            <td class="text-orange-500">{{ $item->role }}</td>
                        @endif

                        @if ($item->status == 'active')
                            <td><span class="px-3 py-1 rounded-full bg-green-300 text-green-600">{{ $item->status }}</span></td>
                        @else
                            <td><span class="px-3 py-1 rounded-full bg-yellow-300 text-yellow-600">{{ $item->status }}</span></td>
                        @endif
                        <td>
                            <button wire:click="edit({{ $item->id }})" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition-colors"><i class="fas fa-edit"></i></button>
                            @if ($item->role !== 'admin')
                                <button wire:click="toggleStatus({{ $item->id }})" 
                                    class="{{ $item->status === 'active' ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white px-3 py-1 rounded text-sm transition-colors"
                                    title="{{ $item->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <i class="fas {{ $item->status === 'active' ? 'fa-ban' : 'fa-check' }}"></i>
                                </button>
                                <button type="button" 
                                    x-data 
                                    x-on:click="
                                        Swal.fire({
                                            title: 'Yakin hapus user ini?',
                                            text: 'Data yang dihapus tidak dapat dikembalikan!',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Ya, Hapus!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $wire.delete({{ $item->id }})
                                            }
                                        })
                                    " 
                                    class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>