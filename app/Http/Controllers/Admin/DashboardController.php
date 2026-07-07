<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UpdateSettingsRequest;
use App\Services\SettingService;
use App\Models\Order;
use App\Models\User;
use App\Models\DeliveryArea;
use App\Models\Category;
use App\Models\Store;
use App\Models\DriverProfile;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct(
        private readonly SettingService $settingService
    ) {}

    public function index()
    {
        $stats = [
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::sum('total_amount'),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_delivery_areas' => DeliveryArea::count(),
            'daily_profits' => Order::whereDate('created_at', Carbon::today())->sum('delivery_fee'),
            'monthly_profits' => Order::whereMonth('created_at', Carbon::now()->month)
                                      ->whereYear('created_at', Carbon::now()->year)
                                      ->sum('delivery_fee'),
        ];

        return view('admin.index', compact('stats'));
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