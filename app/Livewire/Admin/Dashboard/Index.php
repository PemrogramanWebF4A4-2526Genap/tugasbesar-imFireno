<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Order;

class Index extends Component
{
    public $totalUsers = 0;
    public $totalSellers = 0;
    public $totalOrders = 0;
    public $totalRevenue = 0;

    public function mount()
    {
 
    }

    public function render()
    {
        return view('livewire.admin.dashboard.index');
    }
}
