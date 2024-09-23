<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Ticket;

class NotificationService
{
    public function getUserNotifications($userId)
    {
        return Notification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function createNotification($userId, $message)
    {
        $adminId = auth()->id();
        return Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'admin_id' => $adminId,
        ]);
    }

    public function markNotificationAsRead(Notification $notification)
    {
        return $notification->update(['status' => true]);
    }

    public function deleteNotification(Notification $notification)
    {
        return $notification->delete();
    }

}
