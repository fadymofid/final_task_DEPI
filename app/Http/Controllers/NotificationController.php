<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    // Web: Show notifications for authenticated user
    public function index()
    {
        $notifications = $this->notificationService->getUserNotifications(auth()->id());
        return view('user.notification', compact('notifications'));
    }

    // API: Show notifications for API
    public function apiIndex()
    {
        $notifications = $this->notificationService->getUserNotifications(auth()->id());
        return response()->json([
            'success' => true,
            'notifications' => $notifications,
        ]);
    }

    // Web: Store new notification (admin action)
    public function store(NotificationRequest $request)
    {
        if (auth()->user()->type !== 'admin') {
            return redirect()->back()->withErrors(['message' => 'Unauthorized action.']);
        }

        $this->notificationService->createNotification($request->user_id, $request->message);
        return redirect()->route('notifications.index')->with('status', 'Notification sent successfully.');
    }

    // API: Store new notification
    public function apiStore(NotificationRequest $request)
    {
        if (auth()->user()->type !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        $this->notificationService->createNotification($request->user_id, $request->message);
        return response()->json(['success' => true, 'message' => 'Notification sent successfully.']);
    }

    // Web: Mark a notification as read
    public function markAsRead(Notification $notification)
    {
        $this->notificationService->markNotificationAsRead($notification);
        return redirect()->back()->with('status', 'Notification marked as read.');
    }

    // API: Mark notification as read
    public function apiMarkAsRead(Notification $notification)
    {
        $this->notificationService->markNotificationAsRead($notification);
        return response()->json(['success' => true, 'message' => 'Notification marked as read.']);
    }

    // Web: Delete notification
    public function destroy(Notification $notification)
    {
        $this->notificationService->deleteNotification($notification);
        return redirect()->back()->with('status', 'Notification deleted successfully.');
    }

    // API: Delete notification
    public function apiDestroy(Notification $notification)
    {
        $this->notificationService->deleteNotification($notification);
        return response()->json(['success' => true, 'message' => 'Notification deleted successfully.']);
    }
    public function create($userId)
    {
        return view('admin.create_notification', compact('userId')); // Pass the specific user ID to the view
    }

}
