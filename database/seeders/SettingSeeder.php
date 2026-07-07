<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'vodafone_cash_number', 'value' => '01060401725'],
            ['key' => 'etisalat_cash_number', 'value' => '01130424003'],

            ['key' => 'whatsapp_link', 'value' => 'https://wa.me/201060401725'], 
            ['key' => 'facebook_link', 'value' => 'https://facebook.com/ala_elbab'],
            ['key' => 'instagram_link', 'value' => 'https://instagram.com/ala_elbab'],
            ['key' => 'youtube_link', 'value' => 'https://youtube.com/@ala_elbab'],
            ['key' => 'tiktok_link', 'value' => 'https://tiktok.com/@ala_elbab'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']], 
                ['value' => $setting['value']]
            );
        }
    }
}