<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JasaMarket - Temukan Jasa Profesional')</title>



    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

    @include('layout.style')
    @livewireStyles
</head>

<body class="bg-gray-50 text-gray-800 antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Navbar -->
    @include('layout._navbar')

    <!-- Hero Section -->
    <section class="relative pt-24 pb-32 overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 via-white to-teal-50 -z-10"></div>
        <div
            class="absolute top-0 right-0 -translate-y-12 translate-x-1/3 w-[800px] h-[800px] bg-gradient-to-tr from-emerald-200/40 to-teal-100/20 rounded-full blur-3xl -z-10">
        </div>
        <div
            class="absolute bottom-0 left-0 translate-y-1/3 -translate-x-1/3 w-[600px] h-[600px] bg-gradient-to-tr from-blue-100/40 to-emerald-100/40 rounded-full blur-3xl -z-10">
        </div>

        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <!-- Text Content -->
                <div class="max-w-2xl">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100/50 text-emerald-700 font-semibold text-sm mb-6 border border-emerald-200/50 backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        Platform Jasa #1 di Indonesia
                    </div>

                    <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-[1.1] tracking-tight mb-6">
                        Temukan <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Jasa
                            Profesional</span> Untuk Kebutuhan Anda
                    </h1>

                    <p class="text-lg md:text-xl text-gray-600 mb-10 leading-relaxed">
                        JasaMarket menghubungkan Anda dengan ribuan penyedia jasa terpercaya. Dari desain grafis hingga
                        teknisi, semua ada di sini.
                    </p>


                    <div class="mt-8 flex items-center gap-6 text-sm text-gray-500 font-medium">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-500"></i> 100% Aman
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-500"></i> Jasa Terverifikasi
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-500"></i> Harga Transparan
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative hidden lg:block">
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-emerald-500 to-teal-400 rounded-[2.5rem] rotate-3 scale-105 opacity-20 blur-lg">
                    </div>
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2000&auto=format&fit=crop"
                        alt="Profesional bekerja"
                        class="relative rounded-[2.5rem] shadow-2xl border-4 border-white object-cover h-[600px] w-full">

                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-5 rounded-2xl shadow-xl border border-gray-50 flex items-center gap-4 animate-bounce"
                        style="animation-duration: 3s;">
                        <div
                            class="w-12 h-12 bg-orange-100 text-orange-500 rounded-full flex items-center justify-center text-xl">
                            ⭐
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">4.9/5 Rating</p>
                            <p class="text-sm text-gray-500">Dari 10k+ Pengguna</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @yield('content')

    <!-- Categories Section -->
    @include('layout.pembeli._kategori')

    <!-- Popular Services -->
    @livewire('popular-services')

    <!-- How it Works -->
    @include('layout.pembeli._howitworks')

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 pt-16 pb-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-12">
                <div class="col-span-2 lg:col-span-2">
                    <a href="/" class="flex items-center gap-2 mb-6">
                        <div
                            class="w-8 h-8 bg-emerald-600 text-white flex items-center justify-center rounded-lg shadow-sm">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <span class="font-bold text-xl tracking-tight text-gray-900">JasaMarket</span>
                    </a>
                    <p class="text-gray-500 mb-6 max-w-sm leading-relaxed">
                        Platform marketplace jasa terpercaya yang menghubungkan talenta terbaik dengan klien di seluruh
                        Indonesia.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 transition-colors"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 transition-colors"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-500 hover:bg-emerald-50 hover:text-emerald-600 transition-colors"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 mb-4">Kategori</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-500 hover:text-emerald-600 transition-colors">Desain
                                Grafis</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-emerald-600 transition-colors">Digital
                                Marketing</a></li>
                        <li><a href="#"
                                class="text-gray-500 hover:text-emerald-600 transition-colors">Penulisan</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-emerald-600 transition-colors">Video &
                                Animasi</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 mb-4">Tentang</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-500 hover:text-emerald-600 transition-colors">Tentang
                                Kami</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-emerald-600 transition-colors">Cara
                                Kerja</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-emerald-600 transition-colors">Kebijakan
                                Privasi</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-emerald-600 transition-colors">Syarat
                                Ketentuan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 mb-4">Dukungan</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-500 hover:text-emerald-600 transition-colors">Pusat
                                Bantuan</a></li>
                        <li><a href="#"
                                class="text-gray-500 hover:text-emerald-600 transition-colors">Keamanan</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-emerald-600 transition-colors">Hubungi
                                Kami</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-500">© 2026 JasaMarket. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-4 text-sm text-gray-500">
                    <span>ID <i class="fas fa-chevron-down text-xs ml-1"></i></span>
                    <span>Rp (IDR) <i class="fas fa-chevron-down text-xs ml-1"></i></span>
                </div>
            </div>
        </div>
    </footer>



    @include('layout._floatingbar')
    @include('layout.script')
    @livewireScripts
    @include('layout._livewire-sweetalert')
    @livewire('edit-profile')
</body>

</html>
