<?php

namespace App\Services;

use App\Models\Store;
use Illuminate\Support\Facades\Storage;

class StoreService
{
    public function getAllStores()
    {
        return Store::with('category')->latest()->get();
    }

   public function createStore(array $data): Store
    {
        if (isset($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile && $data['logo']->isValid()) {

            $fileName = $data['logo']->hashName();
            Storage::disk('public')->put('stores/' . $fileName, file_get_contents($data['logo']->getPathname()));
            $data['logo'] = 'stores/' . $fileName;
        } else {
            unset($data['logo']);
        }

        $data['is_active'] = filter_var($data['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN);

        return Store::create($data);
    }

    public function updateStore(Store $store, array $data): bool
    {
        if (isset($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile && $data['logo']->isValid()) {
            if ($store->logo) {
                Storage::disk('public')->delete($store->logo);
            }
            $fileName = $data['logo']->hashName();
            Storage::disk('public')->put('stores/' . $fileName, file_get_contents($data['logo']->getPathname()));
            $data['logo'] = 'stores/' . $fileName;
        } else {
            unset($data['logo']);
        }

        $data['is_active'] = filter_var($data['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN);

        return $store->update($data);
    }

    public function deleteStore(Store $store): ?bool
    {
        if ($store->logo) {
            Storage::disk('public')->delete($store->logo);
        }

        return $store->delete();
    }
}