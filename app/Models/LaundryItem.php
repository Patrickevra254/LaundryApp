<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'icon',
        'is_active',
        'washing_price',
        'ironing_price',
        'wash_and_iron_price',
    ];

    // Relationship: An item belongs to a category
    public function category()
    {
        return $this->belongsTo(LaundryCategory::class, 'category_id');
    }
}
