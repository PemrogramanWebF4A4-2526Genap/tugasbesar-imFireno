<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Component
{
    public $name;
    public $isOpen = false;

    public function mount()
    {
        $this->name = Auth::user()->name;
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->save();

        $this->dispatch('notification', message: 'Profil berhasil diperbarui!', type: 'success');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
