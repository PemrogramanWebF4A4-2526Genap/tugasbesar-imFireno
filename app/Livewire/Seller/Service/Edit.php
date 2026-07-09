<?php

namespace App\Livewire\Seller\Service;

use App\Models\Service;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $service;
    public $name;
    public $category_id;
    public $description;
    public $price;
    public $duration;
    public $service_type;
    public $location;
    public $revision;
    public $thumbnail;
    public $status;
    public $existingThumbnail;

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

    public function mount($id)
    {
        $this->service = Service::findOrFail($id);
        
        if ($this->service->seller_id !== auth()->id()) {
            abort(403);
        }

        $this->name = $this->service->name;
        $this->category_id = $this->service->category_id;
        $this->description = $this->service->description;
        $this->price = $this->service->price;
        $this->duration = $this->service->duration;
        $this->service_type = $this->service->service_type;
        $this->location = $this->service->location;
        $this->revision = $this->service->revision;
        $this->status = $this->service->status;
        $this->existingThumbnail = $this->service->thumbnail;
    }

    public function updatedServiceType()
    {
        if ($this->service_type === 'online') {
            $this->location = null;
        }
    }

    public function update()
    {
        $this->validate();

        $thumbnailPath = $this->existingThumbnail;
        
        if ($this->thumbnail) {
            // Delete old thumbnail
            if ($this->existingThumbnail) {
                Storage::disk('public')->delete($this->existingThumbnail);
            }
            $thumbnailPath = $this->thumbnail->store('services/thumbnails', 'public');
        }

        $this->service->update([
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

        session()->flash('success', 'Jasa berhasil diperbarui');

        return redirect()->route('seller.service.index');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.seller.service.edit', compact('categories'));
    }
}
