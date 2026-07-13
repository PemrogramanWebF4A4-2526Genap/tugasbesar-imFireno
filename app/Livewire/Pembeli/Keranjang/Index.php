<?php

namespace App\Livewire\Pembeli\Keranjang;

use App\Services\CartService;
use Livewire\Component;

class Index extends Component
{
    public $cart = [];
    public $total = 0;
    public $selectedItems = [];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = CartService::get();
        $this->calculateTotal();
    }

    public function updatedSelectedItems()
    {
        $this->calculateTotal();
    }

    public function toggleSelection($id)
    {
        if (in_array($id, $this->selectedItems)) {
            $this->selectedItems = array_diff($this->selectedItems, [$id]);
        } else {
            $this->selectedItems[] = $id;
        }
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->selectedItems as $id) {
            if (isset($this->cart[$id])) {
                $this->total += $this->cart[$id]['price'];
            }
        }
    }

    public function removeFromCart($serviceId)
    {
        CartService::remove($serviceId);
        if (in_array($serviceId, $this->selectedItems)) {
            $this->selectedItems = array_diff($this->selectedItems, [$serviceId]);
        }
        $this->loadCart();
        $this->dispatch('notification', message: 'Jasa berhasil dihapus dari keranjang', type: 'success', refresh: true);
    }

    public function clearCart()
    {
        CartService::clear();
        $this->selectedItems = [];
        $this->loadCart();
        $this->dispatch('notification', message: 'Keranjang berhasil dikosongkan', type: 'success', refresh: true);
    }

    public function checkout()
    {
        if (count($this->selectedItems) === 0) {
            $this->dispatch('notification', message: 'Pilih minimal satu jasa untuk dicheckout', type: 'error');
            return;
        }

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Store selected items in session for checkout
        session()->put('checkout_items', $this->selectedItems);

        return redirect()->route('pembeli.checkout');
    }

    public function clearPendingOrder()
    {
        $pendingItems = session()->get('pending_order_items', []);
        
        foreach ($pendingItems as $id) {
            CartService::remove($id);
        }
        
        $this->selectedItems = [];
        session()->forget('pending_order_id');
        session()->forget('pending_order_items');
        $this->loadCart();
    }

    public function render()
    {
        return view('livewire.pembeli.keranjang.index');
    }
}
