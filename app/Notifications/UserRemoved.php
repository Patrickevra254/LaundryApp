<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserRemoved extends Notification
{
    use Queueable;

    public function __construct(public $userName) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'title'   => 'User Removed',
            'message' => "User {$this->userName} has been removed from the system.",
        ];
    }
}
