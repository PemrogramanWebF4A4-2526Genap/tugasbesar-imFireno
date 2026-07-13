<?php

namespace App\Livewire\Seller\Service;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $category_id;
    public $description;
    public $price;
    public $duration;
    public $service_type = 'online';
    public $location;
    public $revision = 0;
    public $thumbnail;
    public $status = 'draft';

    protected $rules = [
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'duration' => 'required|string|max:100',
        'service_type' => 'required|in:online,offline',
        'location' => 'required_if:service_type,offline|nullable|string|max:255',
        'revision' => 'required|integer|min:0',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|in:draft,active,inactive',
    ];

    public function mount()
    {
        // Categories are passed directly to the view via render method
    }

    public function updatedServiceType()
    {
        if ($this->service_type === 'online') {
            $this->location = null;
        }
    }

    public function save()
    {
        $this->validate();

        $thumbnailPath = null;
        if ($this->thumbnail) {
            $thumbnailPath = $this->thumbnail->store('services/thumbnails', 'public');
        }

        auth()->user()->services()->create([
            'name' => $this->name,
            'slug' => Str::slug($this->name) . '-' . time(),
            'category_id' => $this->category_id,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'service_type' => $this->service_type,
            'location' => $this->location,
            'revision' => $this->revision,
            'thumbnail' => $thumbnailPath,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Jasa berhasil dibuat');

        return redirect()->route('seller.service.index');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.seller.service.create', compact('categories'));
    }
}
