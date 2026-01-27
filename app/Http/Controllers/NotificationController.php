<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function markAsRead(DatabaseNotification $notification)
    {
        abort_if($notification->notifiable_id !== auth()->id(), 403);

        $notification->markAsRead();

        return back();
    }

    public function destroy(DatabaseNotification $notification)
    {
        abort_if($notification->notifiable_id !== auth()->id(), 403);

        $notification->delete();

        return back();
    }

    public function destroyAll()
    {
        auth()->user()->notifications()->delete();

        return back();
    }
}
