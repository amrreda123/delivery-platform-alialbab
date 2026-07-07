<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'category_id' => 1,
            'name' => 'متجر الإلكترونيات الأول',
            'is_active' => true,
        ]);

        Store::create([
            'category_id' => 1,
            'name' => 'متجر الملابس العصرية',
            'is_active' => true,
        ]);

        Store::create([
            'category_id' => 1,
            'name' => 'متجر الأطعمة الطازجة',
            'is_active' => true,
        ]);
    }
}
