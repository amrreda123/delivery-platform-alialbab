<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            [
                'name' => 'أحمد حسن (مندوب)',
                'phone' => '01012345678',
                'password' => bcrypt('password'),
                'role' => 'driver',
                'is_active' => true,
                'vehicle_type' => 'motorcycle',
                'is_available' => true,
            ],
            [
                'name' => 'محمود علي (مندوب)',
                'phone' => '01123456789',
                'password' => bcrypt('password'),
                'role' => 'driver',
                'is_active' => true,
                'vehicle_type' => 'bicycle',
                'is_available' => true,
            ],
            [
                'name' => 'مصطفى كمال (مندوب)',
                'phone' => '01234567890',
                'password' => bcrypt('password'),
                'role' => 'driver',
                'is_active' => true,
                'vehicle_type' => 'car',
                'is_available' => false,
            ],
            [
                'name' => 'إبراهيم سعيد (مندوب)',
                'phone' => '01555555555',
                'password' => bcrypt('password'),
                'role' => 'driver',
                'is_active' => false,
                'vehicle_type' => 'motorcycle',
                'is_available' => false,
            ]
        ];

        foreach ($drivers as $data) {
            $user = User::firstOrCreate(
                ['phone' => $data['phone']],
                [
                    'name' => $data['name'],
                    'password' => $data['password'],
                    'role' => $data['role'],
                    'is_active' => $data['is_active'],
                ]
            );

            $user->driverProfile()->firstOrCreate(
                ['user_id' => $user->id],
                [
                    'vehicle_type' => $data['vehicle_type'],
                    'is_available' => $data['is_available'],
                ]
            );
        }
    }
}
