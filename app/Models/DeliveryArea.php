<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['name', 'is_active'])]
class DeliveryArea extends Model
{
    use HasFactory;

    public function addresses()
    {
        return $this->hasMany(Address::class, 'delivery_area_id');
    }
}
