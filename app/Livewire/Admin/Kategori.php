<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class Kategori extends Component
{
    public $categories = [];
    public $name = '';
    public $description = '';
    public $editingId = null;
    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId = null;

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::withCount('services')->latest()->get();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category) {
            $this->editingId = $categoryId;
            $this->name = $category->name;
            $this->description = $category->description;
            $this->showModal = true;
        }
    }

    public function openDeleteModal($categoryId)
    {
        $this->deleteId = $categoryId;
        $this->showDeleteModal = true;
    }

    public function closeModals()
    {
        $this->showModal = false;
        $this->showDeleteModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->editingId = null;
        $this->deleteId = null;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($this->editingId) {
            $category = Category::find($this->editingId);
            $category->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
            $this->dispatch('notification', message: 'Kategori berhasil diperbarui', type: 'success');
        } else {
            Category::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);
            $this->dispatch('notification', message: 'Kategori berhasil ditambahkan', type: 'success');
        }

        $this->closeModals();
        $this->loadCategories();
    }

    public function delete()
    {
        $category = Category::find($this->deleteId);
        if ($category) {
            if ($category->services()->count() > 0) {
                $this->dispatch('notification', message: 'Tidak dapat menghapus kategori yang memiliki jasa', type: 'error');
                $this->showDeleteModal = false;
                return;
            }
            $category->delete();
            $this->dispatch('notification', message: 'Kategori berhasil dihapus', type: 'success');
        }

        $this->closeModals();
        $this->loadCategories();
    }

    public function render()
    {
        return view('livewire.admin.kategori');
    }
}
