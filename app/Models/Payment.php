<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'laundry_order_id',
        'reference',
        'status',
        'amount',
        'currency',
        'method',
        // 'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];


    public function order()
    {
        return $this->belongsTo(LaundryOrder::class, 'laundry_order_id');
    }
}
