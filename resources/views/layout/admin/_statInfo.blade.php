        <div class="grid md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-gray-500">Total User</p>
                <h3 class="text-3xl font-bold mt-2">{{ $stats['total_all_users'] ?? 0 }}</h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-gray-500">Total Seller</p>
                <h3 class="text-3xl font-bold mt-2">{{ $stats['total_sellers'] ?? 0 }}</h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-gray-500">Total Order</p>
                <h3 class="text-3xl font-bold mt-2">{{ $stats['total_orders'] ?? 0 }}</h3>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-gray-500">Pendapatan</p>
                <h3 class="text-3xl font-bold mt-2 text-green-600">
                    Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}
                </h3>
            </div>

        </div>
