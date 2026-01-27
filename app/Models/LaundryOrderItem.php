<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryOrderItem extends Model
{
    protected $fillable = [
        'laundry_order_id',
        'laundry_item_id',
        'item_name',
        'price',
        'service_type',
        'quantity',
        'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(LaundryOrder::class, 'laundry_order_id');
    }
}
