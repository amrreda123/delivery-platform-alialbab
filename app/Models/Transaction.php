<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['order_id', 'driver_id', 'amount', 'type', 'description'])]
class Transaction extends Model
{
    use HasFactory;

    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function driver() : BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

}
