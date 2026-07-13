<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JasaMarket</title>
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

        <!-- Login Card -->
        <div class="bg-white rounded-3xl shadow-xl shadow-emerald-900/5 border border-gray-100 p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang Kembali</h1>
                <p class="text-gray-500">Masuk untuk melanjutkan ke akun Anda</p>
            </div>

            @if(session('failed'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                    {{ session('failed') }}
                </div>
            @endif

            <form class="space-y-5" method="post" action="/login">
                @csrf
                
                @error('email')
                    <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                @enderror
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="email" name="email" id="email"
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 placeholder-gray-400"
                            placeholder="nama@email.com" required>
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

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                        <span class="text-sm text-gray-600">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition-colors">
                        Lupa password?
                    </a>
                </div>

                <button type="submit" class="w-full py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-500">
                    Belum punya akun? <a href="/register" class="font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">Daftar</a>
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
