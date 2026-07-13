<?php

namespace App\Livewire;

use App\Services\NotificationService;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications = [];
    public $unreadCount = 0;
    public $showDropdown = false;

    public function mount()
    {
        if (auth()->check()) {
            $this->loadNotifications();
        }
    }

    public function loadNotifications()
    {
        $this->notifications = NotificationService::getAll(auth()->id());
        $this->unreadCount = NotificationService::getUnreadCount(auth()->id());
    }

    public function markAsRead($notificationId)
    {
        NotificationService::markAsRead($notificationId);
        $this->loadNotifications();
    }

    public function markAllAsRead()
    {
        if (auth()->check()) {
            NotificationService::markAllAsRead(auth()->id());
            $this->loadNotifications();
        }
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
        if ($this->showDropdown) {
            $this->loadNotifications();
        }
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
