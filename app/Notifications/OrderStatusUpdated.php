<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(
        public $order,
        public string $oldStatus,
        public string $newStatus
    ) {}

    /**
     * Delivery channels
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Store notification in database
     */
    public function toDatabase($notifiable): array
    {
        return [
            'title' => 'Order Status Updated',

            'message' => sprintf(
                'Order #%s status changed from %s to %s.',
                $this->order->id,
                $this->humanize($this->oldStatus),
                $this->humanize($this->newStatus)
            ),

            'order_id'   => $this->order->id,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
        ];
    }

    /**
     * Convert in_progress → In Progress
     */
    protected function humanize(string $status): string
    {
        return Str::headline($status);
    }
}
