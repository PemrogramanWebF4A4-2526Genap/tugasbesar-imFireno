<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class PopularServices extends Component
{
    public function render()
    {
        $popularServices = Service::with(['seller', 'category', 'ratings'])
            ->where('status', 'active')
            ->withCount(['orderItems as order_count'])
            ->orderBy('order_count', 'desc')
            ->take(3)
            ->get();

        return view('livewire.popular-services', compact('popularServices'));
    }
}
