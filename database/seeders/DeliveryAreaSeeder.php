<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryArea;

class DeliveryAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            ['name' => 'القومية', 'is_active' => true],
            ['name' => 'فلل الجامعة', 'is_active' => true],
            ['name' => 'المنتزه', 'is_active' => true],
            ['name' => 'المبرة', 'is_active' => true],
            ['name' => 'حي الزهور', 'is_active' => true],
            ['name' => 'شيبة', 'is_active' => true],
            ['name' => 'موقف المنصورة', 'is_active' => true],
            ['name' => 'الغشام', 'is_active' => false], // مثال لمنطقة غير مفعلة مؤقتاً
        ];

        foreach ($areas as $area) {
            DeliveryArea::updateOrCreate(
                ['name' => $area['name']], 
                [
                    'is_active' => $area['is_active']
                ] 
            );
        }
    }
}