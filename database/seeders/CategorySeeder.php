<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'توصيل ملابس',
                'icon' => 'clothes-icon',
                'is_active' => true,
            ],
            [
                'name' => 'توصيل مطاعم',
                'icon' => 'restaurant-icon',
                'is_active' => true,
            ],
            [
                'name' => 'توصيل صيدليات',
                'icon' => 'pharmacy-icon',
                'is_active' => true,
            ],
            [
                'name' => 'توصيل سوبر ماركت',
                'icon' => 'supermarket-icon',
                'is_active' => true,
            ],
            [
                'name' => 'توصيل أي غرض',
                'icon' => 'custom-icon',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
