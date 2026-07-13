<?php

namespace App\Livewire\Seller\Dashboard;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;

class Index extends Component
{
    public $totalOrders = 0;
    public $totalRevenue = 0;
    public $recentOrders = [];

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Get seller's service IDs
        $sellerServiceIds = Service::where('seller_id', auth()->id())->pluck('id')->toArray();

        // Get order IDs that contain seller's services
        $orderIds = OrderItem::whereIn('service_id', $sellerServiceIds)->pluck('order_id')->unique();

        // Calculate total orders
        $this->totalOrders = Order::whereIn('id', $orderIds)->count();

        // Calculate total revenue (only from completed orders)
        $this->totalRevenue = OrderItem::whereIn('order_id', $orderIds)
            ->whereHas('order', function($query) {
                $query->where('status', 'completed');
            })
            ->sum('price');

        // Get recent orders
        $this->recentOrders = Order::whereIn('id', $orderIds)
            ->with(['items.service', 'user'])
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.seller.dashboard.index');
    }
}
