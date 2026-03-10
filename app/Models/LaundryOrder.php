<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class LaundryOrder extends Model
// {
//     protected $fillable = [
//         'customer_id',
//         'pickup_address',
//         'delivery_address',
//         'pickup_date',
//         'delivery_date',
//         'total_items',
//         'subtotal',
//         'service_fee',
//         'total_amount',
//         'status',
//         'payment_status',
//         'created_by',
//     ];

//     public function items()
//     {
//         return $this->hasMany(LaundryOrderItem::class);
//     }

//     public function customer()
//     {
//         return $this->belongsTo(User::class, 'customer_id');
//     }
// }


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'pickup_address',
        'delivery_address',
        'pickup_date',
        'delivery_date',
        'total_items',
        'subtotal',
        'service_fee',
        'total_amount',
        'status',
        'payment_method',
        'payment_timing',
        'payment_status',
        'amount_paid',
        'paystack_reference',
        'created_by',
    ];

    public function items()
    {
        return $this->hasMany(LaundryOrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // ── Helpers ───

    public function getBalanceDueAttribute(): int
    {
        return max(0, $this->total_amount - $this->amount_paid);
    }

    public function getIsFullyPaidAttribute(): bool
    {
        return $this->amount_paid >= $this->total_amount;
    }

    public function getIsPartialAttribute(): bool
    {
        return $this->amount_paid > 0 && $this->amount_paid < $this->total_amount;
    }
}
