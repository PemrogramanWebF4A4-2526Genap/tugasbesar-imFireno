<?php

namespace App\Livewire\Pembeli\Pesanan;

use Livewire\Component;
use App\Models\Order;

class Index extends Component
{
    public $orders = [];
    public $selectedOrder = null;
    public $showModal = false;

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $this->orders = Order::with('items.service.seller')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    }

    public function showOrderDetail($orderId)
    {
        $this->selectedOrder = Order::with('items.service.seller', 'user')
            ->where('id', $orderId)
            ->where('user_id', auth()->id())
            ->first();
        
        if ($this->selectedOrder) {
            $this->showModal = true;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }

    public function render()
    {
        return view('livewire.pembeli.pesanan.index');
    }
}
