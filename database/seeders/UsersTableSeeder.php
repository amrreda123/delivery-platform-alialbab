<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 2 Admins
        $admins = [
            ['name' => 'Admin One', 'email' => 'admin1@admin.com', 'phone' => '01000000001', 'role' => 'admin'],
            ['name' => 'Admin Two', 'email' => 'admin2@admin.com', 'phone' => '01000000002', 'role' => 'admin'],
        ];

        foreach ($admins as $admin) {
            User::firstOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'phone' => $admin['phone'],
                    'password' => Hash::make('password'),
                    'role' => $admin['role'],
                    'is_active' => true,
                ]
            );
        }

        // 2 Customers
        $customers = [
            ['name' => 'Customer One', 'email' => 'customer1@customer.com', 'phone' => '01100000001', 'role' => 'customer'],
            ['name' => 'Customer Two', 'email' => 'customer2@customer.com', 'phone' => '01100000002', 'role' => 'customer'],
        ];

        foreach ($customers as $customer) {
            User::firstOrCreate(
                ['email' => $customer['email']],
                [
                    'name' => $customer['name'],
                    'phone' => $customer['phone'],
                    'password' => Hash::make('password'),
                    'role' => $customer['role'],
                    'is_active' => true,
                ]
            );
        }

        // 2 Drivers
        $drivers = [
            ['name' => 'Driver One', 'email' => 'driver1@driver.com', 'phone' => '01200000001', 'role' => 'driver', 'vehicle_type' => 'motorcycle'],
            ['name' => 'Driver Two', 'email' => 'driver2@driver.com', 'phone' => '01200000002', 'role' => 'driver', 'vehicle_type' => 'bicycle'],
        ];

        foreach ($drivers as $driver) {
            $user = User::firstOrCreate(
                ['email' => $driver['email']],
                [
                    'name' => $driver['name'],
                    'phone' => $driver['phone'],
                    'password' => Hash::make('password'),
                    'role' => $driver['role'],
                    'is_active' => true,
                ]
            );

            $user->driverProfile()->firstOrCreate(
                ['user_id' => $user->id],
                [
                    'vehicle_type' => $driver['vehicle_type'],
                    'is_available' => true,
                ]
            );
        }
    }
}
