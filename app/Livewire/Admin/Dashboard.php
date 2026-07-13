<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\AnalyticsService;

class Dashboard extends Component
{
    public $dailySales = [];
    public $monthlySales = [];
    public $stats = [];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        try {
            $this->dailySales = AnalyticsService::getDailySales(30);
            $this->monthlySales = AnalyticsService::getMonthlySales(12);
            $this->stats = AnalyticsService::getStats();
            
            \Log::info('Dashboard Data Loaded:', [
                'daily_sales_count' => $this->dailySales->count(),
                'monthly_sales_count' => $this->monthlySales->count(),
                'stats' => $this->stats
            ]);
        } catch (\Exception $e) {
            logger()->error('Dashboard mount error: ' . $e->getMessage());
            $this->dailySales = [];
            $this->monthlySales = [];
            $this->stats = [
                'total_revenue' => 0,
                'total_orders' => 0,
                'total_users' => 0,
                'total_sellers' => 0,
                'total_services' => 0,
                'total_all_users' => 0,
            ];
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
