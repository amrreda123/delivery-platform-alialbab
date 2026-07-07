<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id', 'driver_id', 'store_id', 'order_type', 'pickup_address', 
    'pickup_lat', 'pickup_lng', 'address_id', 'dropoff_address', 'dropoff_lat', 
    'dropoff_lng', 'notes', 'image_path', 'invoice_image', 'distance', 
    'items_total', 'delivery_fee', 'total_amount', 'status'
])]
class Order extends Model
{
    use HasFactory;

    public function customer() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function driver() : BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function store() : BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function dropoffAddress() : BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

}
