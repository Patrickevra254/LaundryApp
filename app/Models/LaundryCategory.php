<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryCategory extends Model
{
    protected $fillable = [
        'type',
    ];

    // Relationship: A category has many items
    public function items()
    {
        return $this->hasMany(LaundryItem::class, 'category_id');
    }
}
