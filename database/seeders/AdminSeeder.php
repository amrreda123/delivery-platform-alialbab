<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin 1
        User::updateOrCreate(
            ['email' => config('auth.admin_email')],
            [
                'name' => 'Mohamed Naser ',
                'password' => Hash::make(config('auth.admin_password')),
                'role' => 'admin',
                'phone' => config('auth.admin_phone'),
            ]
        );

        // Admin 2
        User::updateOrCreate(
            ['email' => config('auth.admin2_email')],
            [
                'name' => 'مدير النظام الثاني',
                'password' => Hash::make(config('auth.admin2_password')),
                'role' => 'admin',
                'phone' => config('auth.admin2_phone'),
            ]
        );
    }
}