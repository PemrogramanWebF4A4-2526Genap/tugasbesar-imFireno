<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\AnalyticsService;

class Laporan extends Component
{
    public $dailySales = [];
    public $stats = [];

    public function mount()
    {
        try {
            $this->dailySales = AnalyticsService::getDailySales(30);
            $this->stats = AnalyticsService::getStats();
        } catch (\Exception $e) {
            logger()->error('Laporan mount error: ' . $e->getMessage());
            $this->dailySales = [];
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
        return view('livewire.admin.laporan');
    }
}
