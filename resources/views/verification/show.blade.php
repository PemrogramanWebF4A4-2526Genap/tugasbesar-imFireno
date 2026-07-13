<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification - JasaMarket</title>
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

        <!-- Verification Card -->
        <div class="bg-white rounded-3xl shadow-xl shadow-emerald-900/5 border border-gray-100 p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">
                    @if($loginUserId ?? false)
                        Verifikasi Login
                    @else
                        Verifikasi Akun
                    @endif
                </h1>
                <p class="text-gray-500">
                    @if($loginUserId ?? false)
                        Masukkan kode OTP yang telah dikirim ke email Anda untuk melanjutkan login.
                    @else
                        Masukkan kode OTP yang telah dikirim ke email Anda untuk mengaktifkan akun Anda.
                    @endif
                </p>
            </div>

            @if(session('failed'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                    {{ session('failed') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                    {{ session('error') }}
                </div>
            @endif
            
            <form class="space-y-5" method="post" action="/verify/{{$unique_id}}">
                @method('PUT')
                @csrf
                @error('otp')
                    <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
                @enderror
                <div>
                    <label for="otp" class="block mb-2 text-sm font-medium text-gray-700">Kode OTP</label>
                    <div class="relative">
                        <i class="fas fa-key absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="number" name="otp" id="otp"
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-gray-900 placeholder-gray-400 text-center text-2xl tracking-widest font-semibold"
                            placeholder="000000" required maxlength="6" pattern="[0-9]{6}">
                    </div>
                </div>

                <button type="submit" class="w-full py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25">
                    Verifikasi
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-500 text-sm">
                    @if($loginUserId ?? false)
                        Kembali ke <a href="/login" class="font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">Login</a>
                    @else
                        Belum punya akun? <a href="/register" class="font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">Daftar</a>
                    @endif
                </p>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
</body>
</html>
