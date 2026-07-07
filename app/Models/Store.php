<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'category_id', 'vendor_id', 'name', 'description', 'logo', 
    'address', 'lat', 'lng', 'is_active'
])]
class Store extends Model
{
    use HasFactory;

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function vendor() : BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }

}
