<?php

namespace App\Livewire\Admin\User;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    public $name, $email, $password, $role = 'pembeli', $status = 'active', $user_id;
    public $isOpen = false;

    public function render()
    {
        $totalUsers = User::count();
        $totalSellers = User::where('role', 'penjual')->count();
        $totalBuyers = User::where('role', 'pembeli')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        
        $data = array(
            'users' => User::orderBy('role', 'asc')->get(),
            'totalUsers' => $totalUsers,
            'totalSellers' => $totalSellers,
            'totalBuyers' => $totalBuyers,
            'totalAdmins' => $totalAdmins,
        );
        return view('livewire.admin.user.index', $data);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = 'pembeli';
        $this->status = 'active';
        $this->user_id = '';
    }

    public function store()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role' => 'required|in:admin,pembeli,penjual',
            'status' => 'required|in:active,inactive',
        ];

        if (!$this->user_id) {
            $rules['password'] = 'required|min:6';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'status' => $this->status,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->user_id], $data);

        $this->closeModal();
        $this->resetInputFields();
        $this->dispatch('notification', message: 'User berhasil disimpan!', type: 'success');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->status = $user->status;
        $this->password = '';
        
        $this->openModal();
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user && $user->role !== 'admin') {
            $user->delete();
            $this->dispatch('notification', message: 'User berhasil dihapus!', type: 'success');
        } else {
            $this->dispatch('notification', message: 'Admin tidak bisa dihapus!', type: 'error');
        }
    }

    public function toggleStatus($id)
    {
        $user = User::find($id);
        if ($user) {
            $newStatus = $user->status === 'active' ? 'inactive' : 'active';
            $user->update(['status' => $newStatus]);
            
            $message = $newStatus === 'active' ? 'User berhasil diaktifkan!' : 'User berhasil dinonaktifkan!';
            $this->dispatch('notification', message: $message, type: 'success');
        }
    }
}
