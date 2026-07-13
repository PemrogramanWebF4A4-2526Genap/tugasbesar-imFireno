<?php

namespace App\Livewire\Pembeli;

use Livewire\Component;
use App\Models\Category;
use App\Models\Service;

class Kategori extends Component
{
    public $categories = [];
    public $selectedCategory = null;
    public $services = [];

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::withCount('services')->get();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->loadServices();
    }

    public function loadServices()
    {
        if ($this->selectedCategory) {
            $this->services = Service::with(['seller', 'category'])
                ->where('category_id', $this->selectedCategory)
                ->where('status', 'active')
                ->latest()
                ->get();
        } else {
            $this->services = [];
        }
    }

    public function addToCart($serviceId)
    {
        $result = \App\Services\CartService::add($serviceId);

        $this->dispatch(
            'notification',
            message: $result['message'],
            type: $result['success'] ? 'success' : 'error',
            refresh: $result['success']
        );

        if ($result['success']) {
            // Create notification for cart added
            if (auth()->check()) {
                $service = Service::find($serviceId);
                \App\Services\NotificationService::create(
                    auth()->id(),
                    'cart_added',
                    'Jasa Ditambahkan ke Keranjang',
                    $service->name . ' telah ditambahkan ke keranjang Anda.',
                    ['service_id' => $serviceId, 'service_name' => $service->name]
                );
            }
        }
    }

    public function render()
    {
        return view('livewire.pembeli.kategori');
    }
}
