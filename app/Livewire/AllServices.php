<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\Category;
use App\Services\CartService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AllServices extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $categoryFilter = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 12;
    public $selectedService = null;
    public $showModal = false;
    
    // Rating form properties
    public $rating = 0;
    public $comment = '';
    public $ratingImage;
    public $showRatingForm = false;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $query = Service::with(['seller', 'category', 'ratings'])
            ->where('status', 'active');

        // Search
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        // Filter by category
        if ($this->categoryFilter) {
            $query->where('category_id', $this->categoryFilter);
        }

        // Sorting
        if ($this->sortBy === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sortBy === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($this->sortBy === 'name') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        $services = $query->paginate($this->perPage);
        $categories = Category::all();

        return view('livewire.all-services', compact('services', 'categories'));
    }

    public function showServiceDetail($serviceId)
    {
        $this->selectedService = Service::with(['seller', 'category', 'ratings'])->findOrFail($serviceId);
        $this->showModal = true;
        
        // Check if user already rated this service
        if (auth()->check()) {
            $existingRating = \App\Models\Rating::where('user_id', auth()->id())
                ->where('service_id', $serviceId)
                ->first();
            
            if ($existingRating) {
                $this->rating = $existingRating->rating;
                $this->comment = $existingRating->comment;
            } else {
                $this->rating = 0;
                $this->comment = '';
            }
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedService = null;
        $this->showRatingForm = false;
        $this->rating = 0;
        $this->comment = '';
        $this->ratingImage = null;
    }

    public function submitRating()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'ratingImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if user already rated this service
        $existingRating = \App\Models\Rating::where('user_id', auth()->id())
            ->where('service_id', $this->selectedService->id)
            ->first();

        $imagePath = null;
        if ($this->ratingImage) {
            $imagePath = $this->ratingImage->store('ratings', 'public');
        }

        if ($existingRating) {
            // Update existing rating
            if ($imagePath && $existingRating->image) {
                \Storage::disk('public')->delete($existingRating->image);
            }
            $existingRating->rating = $this->rating;
            $existingRating->comment = $this->comment;
            if ($imagePath) {
                $existingRating->image = $imagePath;
            }
            $existingRating->save();
        } else {
            // Create new rating
            \App\Models\Rating::create([
                'user_id' => auth()->id(),
                'service_id' => $this->selectedService->id,
                'rating' => $this->rating,
                'comment' => $this->comment,
                'image' => $imagePath,
            ]);
        }

        // Refresh service data
        $this->selectedService = Service::with(['seller', 'category', 'ratings'])->findOrFail($this->selectedService->id);
        
        $this->dispatch('notification', message: 'Rating berhasil disimpan', type: 'success');
    }

    public function addToCart($serviceId)
    {
        $result = CartService::add($serviceId);

        $this->dispatch(
            'notification',
            message: $result['message'],
            type: $result['success'] ? 'success' : 'error',
            refresh: $result['success']
        );

        if ($result['success']) {
            // Create notification for cart added
            if (auth()->check()) {
                $service = \App\Models\Service::find($serviceId);
                \App\Services\NotificationService::create(
                    auth()->id(),
                    'cart_added',
                    'Jasa Ditambahkan ke Keranjang',
                    $service->name . ' telah ditambahkan ke keranjang Anda.',
                    ['service_id' => $serviceId, 'service_name' => $service->name]
                );
            }
            $this->closeModal();
        }
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
}
