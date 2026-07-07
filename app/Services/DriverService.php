<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class DriverService
{
    public function getPaginatedDrivers(int $perPage = 15)
    {
        return User::where('role', 'driver')
                   ->with('driverProfile')
                   ->latest()
                   ->paginate($perPage);
    }

    public function assignDriverRole(array $data): void
    {
        $user = User::where('phone', $data['phone'])->firstOrFail();

        if ($user->role === 'driver') {
            throw ValidationException::withMessages([
                'phone' => 'هذا المستخدم مسجل كمندوب بالفعل.'
            ]);
        }

        $user->update(['role' => 'driver']);

        $user->driverProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'vehicle_type' => $data['vehicle_type'],
                'is_available' => true,
            ]
        );
    }

    public function updateDriverInfo(User $driver, array $data): void
    {
        $isActive = filter_var($data['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $isAvailable = filter_var($data['is_available'] ?? false, FILTER_VALIDATE_BOOLEAN);

        $driver->update(['is_active' => $isActive]);

        $driver->driverProfile()->updateOrCreate(
            ['user_id' => $driver->id],
            [
                'vehicle_type' => $data['vehicle_type'],
                'is_available' => $isAvailable,
            ]
        );
    }

    public function revokeDriverRole(User $driver): void
    {
        $driver->update(['role' => 'customer']);
        
        if ($driver->driverProfile) {
            $driver->driverProfile()->delete();
        }
    }
}