<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.index', compact('settings'));
    }
    public function editSettings()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        
        return view('admin.settings', compact('settings'));
    }
    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'vodafone_cash_number' => 'required|string',
            'etisalat_cash_number' => 'required|string',
            'whatsapp_link'        => 'required|url',
            'facebook_link'        => 'required|url',
            'instagram_link'       => 'required|url',
            'youtube_link'         => 'required|url',
            'tiktok_link'          => 'required|url',
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],  
                ['value' => $value] 
            );
        }

        return redirect()->back()->with('success', 'تم تحديث إعدادات النظام بنجاح!');
    }
}