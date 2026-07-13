<div>
    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
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
                    <p class="text-sm text-gray-500 mb-1">Rata-rata Pendapatan/Hari</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['total_orders'] > 0 ? $stats['total_revenue'] / 30 : 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Rata-rata Pesanan/Hari</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_orders'] / 30, 1) }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-receipt text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Daily Sales Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Penjualan Harian (30 Hari Terakhir)</h3>
        <div class="h-96">
            <canvas id="dailySalesChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dailyCtx = document.getElementById('dailySalesChart');
            if (dailyCtx) {
                const dailyLabels = @json($dailySales->pluck('date')->toArray());
                const dailyRevenue = @json($dailySales->pluck('total')->toArray());
                const dailyOrders = @json($dailySales->pluck('count')->toArray());
                
                console.log('Daily Labels:', dailyLabels);
                console.log('Daily Revenue:', dailyRevenue);
                console.log('Daily Orders:', dailyOrders);
                
                if (dailyLabels.length > 0 && dailyRevenue.length > 0) {
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
            }
        });
    </script>
@endpush
