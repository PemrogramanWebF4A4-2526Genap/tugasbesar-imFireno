<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    /**
     * Create a notification for a user
     */
    public static function create($userId, $type, $title, $message, $data = null)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
            'is_read' => false,
        ]);
    }

    /**
     * Get unread notifications for a user
     */
    public static function getUnread($userId)
    {
        return Notification::forUser($userId)
            ->unread()
            ->latest()
            ->get();
    }

    /**
     * Get all notifications for a user
     */
    public static function getAll($userId)
    {
        return Notification::forUser($userId)
            ->latest()
            ->get();
    }

    /**
     * Mark notification as read
     */
    public static function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->update(['is_read' => true]);
        }
    }

    /**
     * Mark all notifications as read for a user
     */
    public static function markAllAsRead($userId)
    {
        Notification::forUser($userId)
            ->unread()
            ->update(['is_read' => true]);
    }

    /**
     * Get unread count for a user
     */
    public static function getUnreadCount($userId)
    {
        return Notification::forUser($userId)
            ->unread()
            ->count();
    }
}
