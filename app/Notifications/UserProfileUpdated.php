<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

// class UserProfileUpdated extends Notification
// {
//     use Queueable;

//     public function __construct(public $user)
//     {
//     }

//     public function via($notifiable): array
//     {
//         return ['database'];
//     }

//     public function toDatabase($notifiable): array
//     {
//         return [
//             'title'   => 'User Profile Updated',
//             'message' => "{$this->user->name} updated their profile.",
//             'user_id' => $this->user->id,
//         ];
//     }
// }



class UserProfileUpdated extends Notification
{
    use Queueable;

    public function __construct(
        public $user,
        public string $recipientType = 'admin' // 'admin' or 'customer'
    ) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        if ($this->recipientType === 'customer') {
            return [
                'title'   => 'Profile Updated',
                'message' => 'Your profile has been updated successfully. If you did not make this change, please contact support.',
                'user_id' => $this->user->id,
                'type'    => 'customer',
            ];
        }

        // Admin / SuperAdmin message
        return [
            'title'   => 'User Profile Updated',
            'message' => "{$this->user->name} updated his/her profile.",
            'user_id' => $this->user->id,
            'type'    => 'admin',
        ];
    }
}
