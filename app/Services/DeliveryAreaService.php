<?php

namespace App\Services;

use App\Models\DeliveryArea;
use Illuminate\Database\Eloquent\Collection;

class DeliveryAreaService
{
    public function getAllAreas(): Collection
    {
        return DeliveryArea::latest()->get();
    }

    public function createArea(array $data): DeliveryArea
    {
        $data['is_active'] = filter_var($data['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN);

        return DeliveryArea::create($data);
    }

    public function updateArea(DeliveryArea $deliveryArea, array $data): bool
    {
        $data['is_active'] = filter_var($data['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN);

        return $deliveryArea->update($data);
    }

    public function deleteArea(DeliveryArea $deliveryArea): ?bool
    {
        return $deliveryArea->delete();
    }
}
