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
            ],
            [
                'name' => 'محمود علي (مندوب)',
                'phone' => '01123456789',
                'password' => bcrypt('password'),
                'role' => 'driver',
                'is_active' => true,
            ],
            [
                'name' => 'مصطفى كمال (مندوب)',
                'phone' => '01234567890',
                'password' => bcrypt('password'),
                'role' => 'driver',
                'is_active' => true,
            ],
            [
                'name' => 'إبراهيم سعيد (مندوب)',
                'phone' => '01555555555',
                'password' => bcrypt('password'),
                'role' => 'driver',
                'is_active' => false,
            ]
        ];

        foreach ($drivers as $driver) {
            User::firstOrCreate(
                ['phone' => $driver['phone']],
                $driver
            );
        }
    }
}
