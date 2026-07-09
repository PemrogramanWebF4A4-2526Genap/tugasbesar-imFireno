<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">

    <!-- Navbar -->
    @include('layout._navbar')
    @include('layout._floatingbar')

    <!-- Hero -->
    <section class="container mx-auto px-6 py-20">

        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div>
                <h1 class="text-5xl font-bold text-gray-800 leading-tight">
                    Temukan Jasa Profesional
                    Untuk Kebutuhan Anda
                </h1>

                <p class="mt-6 text-gray-600 text-lg">
                    JasaMarket menghubungkan pelanggan dengan penyedia jasa terpercaya
                    mulai dari teknisi, desain grafis, fotografi, cleaning service,
                    hingga les privat.
                </p>

                <div class="mt-8 flex gap-4">
                    <a href="#"
                       class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold">
                        Cari Jasa
                    </a>

                    <a href="#"
                       class="bg-orange-500 text-white px-6 py-3 rounded-xl font-semibold">
                        Jadi Mitra
                    </a>
                </div>
            </div>

            <div>
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                     class="rounded-3xl shadow-xl">
            </div>

        </div>

    </section>

    <!-- Search -->
    <section class="container mx-auto px-6">

        <div class="bg-white shadow-lg rounded-2xl p-6">

            <h2 class="font-bold text-xl mb-4">
                Cari Jasa
            </h2>

            <div class="grid md:grid-cols-4 gap-4">

                <input type="text"
                    placeholder="Cari jasa..."
                    class="border rounded-xl p-3">

                <select class="border rounded-xl p-3">
                    <option>Kategori</option>
                    <option>Cleaning Service</option>
                    <option>Fotografi</option>
                    <option>Les Privat</option>
                </select>

                <input type="text"
                    placeholder="Lokasi"
                    class="border rounded-xl p-3">

                <button class="bg-blue-600 text-white rounded-xl">
                    Cari Sekarang
                </button>

            </div>

        </div>

    </section>

    <!-- Kategori -->
    <section class="container mx-auto px-6 py-16">

        <h2 class="text-3xl font-bold text-center mb-10">
            Kategori Populer
        </h2>

        <div class="grid md:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl p-6 shadow text-center">
                🧹
                <h3 class="font-bold mt-3">Cleaning Service</h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow text-center">
                🔧
                <h3 class="font-bold mt-3">Teknisi</h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow text-center">
                📷
                <h3 class="font-bold mt-3">Fotografi</h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow text-center">
                🎓
                <h3 class="font-bold mt-3">Les Privat</h3>
            </div>

        </div>

    </section>

    <!-- Jasa Populer -->
    <section class="container mx-auto px-6 pb-20">

        <h2 class="text-3xl font-bold mb-10">
            Jasa Terpopuler
        </h2>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white rounded-2xl shadow overflow-hidden">

                <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952"
                    class="h-56 w-full object-cover">

                <div class="p-5">

                    <h3 class="font-bold text-lg">
                        Cleaning Service Rumah
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Oleh Budi Service
                    </p>

                    <div class="flex justify-between mt-4">
                        <span class="font-bold text-blue-600">
                            Rp150.000
                        </span>

                        <span>
                            ⭐ 4.9
                        </span>
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow overflow-hidden">

                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3"
                    class="h-56 w-full object-cover">

                <div class="p-5">

                    <h3 class="font-bold text-lg">
                        Jasa Desain Logo
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Oleh Creative Studio
                    </p>

                    <div class="flex justify-between mt-4">
                        <span class="font-bold text-blue-600">
                            Rp250.000
                        </span>

                        <span>
                            ⭐ 4.8
                        </span>
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow overflow-hidden">

                <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085"
                    class="h-56 w-full object-cover">

                <div class="p-5">

                    <h3 class="font-bold text-lg">
                        Service Komputer
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Oleh Tech Solution
                    </p>

                    <div class="flex justify-between mt-4">
                        <span class="font-bold text-blue-600">
                            Rp200.000
                        </span>

                        <span>
                            ⭐ 5.0
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Cara Kerja -->
    <section class="bg-blue-600 py-20">

        <div class="container mx-auto px-6">

            <h2 class="text-4xl font-bold text-white text-center mb-12">
                Cara Kerja
            </h2>

            <div class="grid md:grid-cols-3 gap-8 text-center">

                <div class="bg-white rounded-2xl p-8">
                    <h3 class="font-bold text-xl mb-3">
                        1. Cari Jasa
                    </h3>
                    <p>
                        Pilih jasa yang sesuai kebutuhan.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8">
                    <h3 class="font-bold text-xl mb-3">
                        2. Pesan
                    </h3>
                    <p>
                        Lakukan pemesanan dengan mudah.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8">
                    <h3 class="font-bold text-xl mb-3">
                        3. Selesai
                    </h3>
                    <p>
                        Nikmati layanan terbaik dari mitra kami.
                    </p>
                </div>

            </div>

        </div>

    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-8">

        <div class="container mx-auto px-6 text-center">

            <h3 class="font-bold text-xl">
                JasaMarket
            </h3>

            <p class="text-gray-400 mt-2">
                Solusi Jasa & Layanan Terpercaya
            </p>

        </div>

    </footer>
    <script>
        const profileButton = document.getElementById('profileButton');
        const profileMenu = document.getElementById('profileMenu');
        
        profileButton.addEventListener('click', () => {
            profileMenu.classList.toggle('hidden');
        });
        
        document.addEventListener('click', function(e) {
            if (!profileButton.contains(e.target) &&
                !profileMenu.contains(e.target)) {
        
                profileMenu.classList.add('hidden');
            }
        });
    </script>

</body>
</html>