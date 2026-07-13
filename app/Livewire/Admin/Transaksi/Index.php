<?php

namespace App\Livewire\Admin\Transaksi;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $perPage = 10;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $query = Order::with(['user', 'items.service.seller']);

        // Search
        if ($this->search) {
            $query->where('id', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function ($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
        }

        // Filter by status
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('livewire.admin.transaksi.index', compact('orders'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
}
