<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;

        return response()->json(['notifications' => $notifications]);
    }
    public function getUnreadNotifications(Request $request)
    {
        $user = $request->user();
        $unreadNotifications = $user->unreadNotifications;

        return response()->json(['notifications' => $unreadNotifications]);
    }

    public function markNotificationsAsRead(Request $request)
    {
        $user = $request->user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    public function getAllNotifications(Request $request)
    {

        if (auth()->check()) {

            $notifications = auth()->user()->notifications;
            return response()->json(['notifications' => $notifications]);
        }


        // Handle the case where the user is not authenticated
        return response()->json(['message' => 'User not authenticated'], 401);
    }
    public function markNotification(Request $request, $id)
    {

        try {
            $notification = auth()->user()->unreadNotifications
                ->where('id', $id)
                ->firstOrFail();

            $notification->markAsRead();

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            // Handle the case when the notification is not found
            return response()->json(['error' => 'Notification not found'], 404);
        }
    }
}
