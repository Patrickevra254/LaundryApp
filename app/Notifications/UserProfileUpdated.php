<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserProfileUpdated extends Notification
{
    use Queueable;

    public function __construct(public $user)
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'title'   => 'User Profile Updated',
            'message' => "{$this->user->name} updated their profile.",
            'user_id' => $this->user->id,
        ];
    }
}
