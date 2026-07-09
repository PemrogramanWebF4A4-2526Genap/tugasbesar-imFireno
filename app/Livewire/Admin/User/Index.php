<?php

namespace App\Livewire\Admin\User;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $data = array(
            'users' => User::orderBy('role', 'asc')->get(),
        );
        return view('livewire.admin.user.index', $data);
    }
}
