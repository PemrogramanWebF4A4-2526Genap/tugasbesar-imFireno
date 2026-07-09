<?php

namespace App\Livewire\Seller\Service;

use App\Models\Service;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $confirmDeleteId = null;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $query = Service::where('seller_id', auth()->id())
            ->with('category');

        // Search
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Filter by category
        if ($this->categoryFilter) {
            $query->where('category_id', $this->categoryFilter);
        }

        // Filter by status
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        // Sorting
        $query->orderBy($this->sortBy, $this->sortDirection);

        $services = $query->paginate($this->perPage);
        $categories = Category::all();

        return view('livewire.seller.service.index', compact('services', 'categories'));
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        
        if ($service->seller_id !== auth()->id()) {
            abort(403);
        }

        if ($service->thumbnail) {
            Storage::disk('public')->delete($service->thumbnail);
        }

        $service->delete();
        
        $this->confirmDeleteId = null;
        
        session()->flash('success', 'Jasa berhasil dihapus');
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function cancelDelete()
    {
        $this->confirmDeleteId = null;
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
}
