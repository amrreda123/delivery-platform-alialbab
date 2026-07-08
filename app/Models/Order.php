<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Str;

#[Fillable([
    'tracking_code', 'user_id', 'driver_id', 'store_id', 'order_type', 'pickup_address', 
    'address_id', 'dropoff_address', 'notes', 'items_total', 
    'delivery_fee', 'total_amount', 'status'
])]
class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->tracking_code)) {
                do {
                    // Generate a 10-character code using Laravel's secure generator (letters, numbers, symbols)
                    $code = Str::password(10, true, true, true, false);
                } while (Order::where('tracking_code', $code)->exists());
                $order->tracking_code = $code;
            }
        });
    }

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
