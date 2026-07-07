<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getPaginatedCustomers(int $perPage = 15)
    {
        return User::where('role', 'customer')->latest()->paginate($perPage);
    }

    public function createCustomer(array $data): void
    {
        User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'role' => 'customer',
            'is_active' => filter_var($data['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    public function updateCustomerStatus(User $user, array $data): void
    {
        $user->update([
            'is_active' => filter_var($data['is_active'] ?? false, FILTER_VALIDATE_BOOLEAN)
        ]);
    }

    public function deleteCustomer(User $user): void
    {
        $user->delete();
    }
}
