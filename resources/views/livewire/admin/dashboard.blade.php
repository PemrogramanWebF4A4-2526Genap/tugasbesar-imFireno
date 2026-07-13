<div>
    @include('layout.admin._statInfo')

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-emerald-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Pesanan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Pengguna</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_all_users'] }}</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-indigo-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Pembeli</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Penjual</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_sellers'] }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-store text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Jasa</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_services'] }}</p>
                </div>
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-tools text-teal-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Daily Sales Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Penjualan Harian (30 Hari Terakhir)</h3>
            @if($dailySales->isEmpty())
                <div class="h-80 flex items-center justify-center text-gray-500">
                    <p>Belum ada data penjualan</p>
                </div>
            @else
                <div class="h-80">
                    <canvas id="dailySalesChart"></canvas>
                </div>
            @endif
        </div>

        <!-- Monthly Sales Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Penjualan Bulanan (12 Bulan Terakhir)</h3>
            @if($monthlySales->isEmpty())
                <div class="h-80 flex items-center justify-center text-gray-500">
                    <p>Belum ada data penjualan</p>
                </div>
            @else
                <div class="h-80">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Daily Sales Chart
            @if(!$dailySales->isEmpty())
                const dailyCtx = document.getElementById('dailySalesChart');
                if (dailyCtx) {
                    const dailyLabels = @json($dailySales->pluck('date')->toArray());
                    const dailyRevenue = @json($dailySales->pluck('total')->toArray());
                    const dailyOrders = @json($dailySales->pluck('count')->toArray());
                    
                    console.log('Daily Labels:', dailyLabels);
                    console.log('Daily Revenue:', dailyRevenue);
                    console.log('Daily Orders:', dailyOrders);
                    
                    new Chart(dailyCtx, {
                        type: 'bar',
                        data: {
                            labels: dailyLabels,
                            datasets: [
                                {
                                    label: 'Pendapatan (Rp)',
                                    data: dailyRevenue,
                                    backgroundColor: '#3b82f6',
                                    borderRadius: 4,
                                    yAxisID: 'y'
                                },
                                {
                                    label: 'Jumlah Pesanan',
                                    data: dailyOrders,
                                    borderColor: '#f59e0b',
                                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                    type: 'line',
                                    tension: 0.4,
                                    yAxisID: 'y1'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true
                                }
                            },
                            scales: {
                                y: {
                                    type: 'linear',
                                    display: true,
                                    position: 'left',
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString('id-ID');
                                        }
                                    }
                                },
                                y1: {
                                    type: 'linear',
                                    display: true,
                                    position: 'right',
                                    beginAtZero: true,
                                    grid: {
                                        drawOnChartArea: false
                                    }
                                }
                            }
                        }
                    });
                }
            @endif

            // Monthly Sales Chart
            @if(!$monthlySales->isEmpty())
                const monthlyCtx = document.getElementById('monthlySalesChart');
                if (monthlyCtx) {
                    const monthlyLabels = @json($monthlySales->pluck('month')->toArray());
                    const monthlyRevenue = @json($monthlySales->pluck('total')->toArray());
                    const monthlyOrders = @json($monthlySales->pluck('count')->toArray());
                    
                    console.log('Monthly Labels:', monthlyLabels);
                    console.log('Monthly Revenue:', monthlyRevenue);
                    console.log('Monthly Orders:', monthlyOrders);
                    
                    new Chart(monthlyCtx, {
                        type: 'line',
                        data: {
                            labels: monthlyLabels,
                            datasets: [
                                {
                                    label: 'Pendapatan (Rp)',
                                    data: monthlyRevenue,
                                    borderColor: '#10b981',
                                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                    fill: true,
                                    tension: 0.4,
                                    yAxisID: 'y'
                                },
                                {
                                    label: 'Jumlah Pesanan',
                                    data: monthlyOrders,
                                    borderColor: '#f59e0b',
                                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                    type: 'line',
                                    tension: 0.4,
                                    yAxisID: 'y1'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true
                                }
                            },
                            scales: {
                                y: {
                                    type: 'linear',
                                    display: true,
                                    position: 'left',
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString('id-ID');
                                        }
                                    }
                                },
                                y1: {
                                    type: 'linear',
                                    display: true,
                                    position: 'right',
                                    beginAtZero: true,
                                    grid: {
                                        drawOnChartArea: false
                                    }
                                }
                            }
                        }
                    });
                }
            @endif
        });
    </script>
@endpush
