<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - JasaMarket</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    
    <!-- Background decoration -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute top-0 right-0 -translate-y-12 translate-x-1/3 w-[800px] h-[800px] bg-gradient-to-tr from-emerald-200/40 to-teal-100/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/3 -translate-x-1/3 w-[600px] h-[600px] bg-gradient-to-tr from-blue-100/40 to-emerald-100/40 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 group">
                <div class="w-12 h-12 bg-emerald-600 text-white flex items-center justify-center rounded-xl shadow-sm group-hover:scale-105 transition-transform">
                    <i class="fas fa-layer-group text-xl"></i>
                </div>
                <span class="font-bold text-2xl tracking-tight text-gray-900 group-hover:text-emerald-600 transition-colors">JasaMarket</span>
            </a>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-3xl shadow-xl shadow-emerald-900/5 border border-gray-100 p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Buat Akun Baru</h1>
                <p class="text-gray-500">Daftar untuk mulai menggunakan JasaMarket</p>
            </div>

            @if(session('failed'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                    {{ session('failed') }}
                </div>
            @endif

            <form class="space-y-5" method="post" action="/register">
                @csrf
                
                @error('name')
                    <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                @enderror
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="name" id="name"
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 placeholder-gray-400"
                            placeholder="Nama Anda" required value="{{ old('name') }}">
                    </div>
                </div>

                @error('email')
                    <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                @enderror
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="email" name="email" id="email"
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 placeholder-gray-400"
                            placeholder="nama@email.com" required value="{{ old('email') }}">
                    </div>
                </div>

                @error('password')
                    <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                @enderror
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="password" name="password" id="password"
                            class="w-full pl-12 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 placeholder-gray-400"
                            placeholder="••••••••" required>
                        <button type="button" onclick="togglePassword('password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                @error('confirm_password')
                    <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                @enderror
                <div>
                    <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="password" name="confirm_password" id="confirm_password"
                            class="w-full pl-12 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 placeholder-gray-400"
                            placeholder="••••••••" required>
                        <button type="button" onclick="togglePassword('confirm_password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                @error('role')
                    <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                @enderror
                <div>
                    <label class="block mb-3 text-sm font-medium text-gray-700">Daftar sebagai</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="pembeli" class="peer sr-only" checked>
                            <div class="p-4 bg-gray-50 border-2 border-gray-200 rounded-xl peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:border-emerald-300">
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-2 shadow-sm peer-checked:bg-emerald-100">
                                        <i class="fas fa-shopping-bag text-emerald-600 text-xl"></i>
                                    </div>
                                    <span class="font-semibold text-gray-900 peer-checked:text-emerald-700">Pembeli</span>
                                    <span class="text-xs text-gray-500 mt-1">Cari jasa</span>
                                </div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="penjual" class="peer sr-only">
                            <div class="p-4 bg-gray-50 border-2 border-gray-200 rounded-xl peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:border-emerald-300">
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-2 shadow-sm peer-checked:bg-emerald-100">
                                        <i class="fas fa-store text-emerald-600 text-xl"></i>
                                    </div>
                                    <span class="font-semibold text-gray-900 peer-checked:text-emerald-700">Penjual</span>
                                    <span class="text-xs text-gray-500 mt-1">Jual jasa</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25">
                    Daftar
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-500">
                    Sudah punya akun? <a href="/login" class="font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">Masuk</a>
                </p>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
    
    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
