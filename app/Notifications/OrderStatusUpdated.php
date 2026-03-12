<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

// class OrderStatusUpdated extends Notification
// {
//     use Queueable;

//     public function __construct(
//         public $order,
//         public string $oldStatus,
//         public string $newStatus
//     ) {}

//     /**
//      * Delivery channels
//      */
//     public function via($notifiable): array
//     {
//         return ['database'];
//     }

//     /**
//      * Store notification in database
//      */
//     public function toDatabase($notifiable): array
//     {
//         return [
//             'title' => 'Order Status Updated',

//             'message' => sprintf(
//                 'Order #%s status changed from %s to %s.',
//                 $this->order->id,
//                 $this->humanize($this->oldStatus),
//                 $this->humanize($this->newStatus)
//             ),

//             'order_id'   => $this->order->id,
//             'old_status' => $this->oldStatus,
//             'new_status' => $this->newStatus,
//         ];
//     }

//     /**
//      * Convert in_progress → In Progress
//      */
//     protected function humanize(string $status): string
//     {
//         return Str::headline($status);
//     }
// }

class OrderStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(
        public $order,
        public string $oldStatus,
        public string $newStatus,
        public string $recipientType = 'admin' // 'admin' or 'customer'
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
        if ($this->recipientType === 'customer') {
            return [
                'title'      => $this->customerTitle(),
                'message'    => $this->customerMessage(),
                'order_id'   => $this->order->id,
                'old_status' => $this->oldStatus,
                'new_status' => $this->newStatus,
                'type'       => 'customer',
            ];
        }

        // Admin / SuperAdmin message
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
            'type'       => 'admin',
        ];
    }

    /**
     * Short friendly title for the customer based on new status
     */
    protected function customerTitle(): string
    {
        return match ($this->newStatus) {
            'pending'     => 'Order Received',
            'In progress' => 'Your Laundry is Being Processed',
            'completed'   => 'Your Laundry is Ready!',
            'delivered'   => 'Order Delivered',
            default       => 'Order Update',
        };
    }

    /**
     * Friendly message body for the customer
     */
    protected function customerMessage(): string
    {
        $id = $this->order->id;

        return match ($this->newStatus) {
            'pending'     => "We've received your order #$id and it's queued for processing.",
            'In progress' => "Great news! Order #$id is now being washed and/or ironed. We'll let you know when it's done.",
            'completed'   => "Order #$id is ready! We'll arrange delivery or you can pick it up at the store.",
            'delivered'   => "Order #$id has been delivered. Thank you for choosing us! 🎉",
            default       => "Your order #$id has been updated to {$this->humanize($this->newStatus)}.",
        };
    }

    /**
     * Convert in_progress → In Progress
     */
    protected function humanize(string $status): string
    {
        return Str::headline($status);
    }
}
