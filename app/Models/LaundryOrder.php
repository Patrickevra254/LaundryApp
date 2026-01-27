<?php

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
        // 'service_type',
        'total_items',
        'subtotal',
        'service_fee',
        'total_amount',
        'status',
        'payment_status',
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
}
