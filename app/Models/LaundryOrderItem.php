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
        // care details
        'description',
        'observations',
        'requirements',
        'starch_level',
        'heat_level',
        'finish',
        'extra_charge',
    ];

    public function order()
    {
        return $this->belongsTo(LaundryOrder::class, 'laundry_order_id');
    }

    public function laundryItem()
    {
        return $this->belongsTo(LaundryItem::class, 'laundry_item_id');
    }

    // ── Label helpers (useful in views & invoices) ────────────

    public function getStarchLabelAttribute(): string
    {
        return match ($this->starch_level) {
            'none'   => 'No Starch',
            'low'    => 'Low Starch',
            'medium' => 'Medium Starch',
            'high'   => 'High Starch',
            default  => '—',
        };
    }

    public function getHeatLabelAttribute(): string
    {
        return match ($this->heat_level) {
            'low'    => 'Low Heat',
            'medium' => 'Medium Heat',
            'high'   => 'High Heat',
            default  => '—',
        };
    }

    public function getFinishLabelAttribute(): string
    {
        return match ($this->finish) {
            'folded' => 'Folded',
            'hanged' => 'Hanged',
            default  => '—',
        };
    }
}
