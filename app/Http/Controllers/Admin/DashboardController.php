<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UpdateSettingsRequest;
use App\Services\SettingService;

class DashboardController extends Controller
{
    public function __construct(
        private readonly SettingService $settingService
    ) {}

    public function index()
    {
        return view('admin.index');
    }
    public function editSettings()
    {
        return view('admin.settings');
    }
    public function updateSettings(UpdateSettingsRequest $request)
    {
        $this->settingService->updateAllSettings($request->validated());

        return redirect()->back()->with('success', 'تم تحديث إعدادات النظام بنجاح!');
    }
   
}