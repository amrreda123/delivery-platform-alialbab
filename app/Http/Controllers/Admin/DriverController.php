<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\DriverService;
use App\Http\Requests\Admin\StoreDriverRequest;
use App\Http\Requests\Admin\UpdateDriverRequest;

class DriverController extends Controller
{
    public function __construct(
        private readonly DriverService $driverService
    ) {}

    public function index()
    {
        $drivers = $this->driverService->getPaginatedDrivers();
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(StoreDriverRequest $request)
    {
        $this->driverService->assignDriverRole($request->validated());

        return redirect()->route('admin.drivers.index')
                         ->with('success', 'تم تحويل المستخدم إلى مندوب بنجاح');
    }

    public function show(User $driver)
    {
        $this->checkDriverRole($driver);
        
        $driver->load('driverProfile');
        $orders = \App\Models\Order::where('driver_id', $driver->id)->with(['customer', 'store'])->latest()->paginate(15);
        
        $totalOrders = \App\Models\Order::where('driver_id', $driver->id)->count();
        $totalDeliveryFees = \App\Models\Order::where('driver_id', $driver->id)->where('status', 'delivered')->sum('delivery_fee');

        return view('admin.drivers.show', compact('driver', 'orders', 'totalOrders', 'totalDeliveryFees'));
    }

    public function edit(User $driver)
    {
        $this->checkDriverRole($driver);
        
        $driver->load('driverProfile');
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(UpdateDriverRequest $request, User $driver)
    {
        $this->checkDriverRole($driver);

        $this->driverService->updateDriverInfo($driver, $request->validated());

        return redirect()->route('admin.drivers.index')
                         ->with('success', 'تم تعديل بيانات المندوب بنجاح');
    }

    public function destroy(User $driver)
    {
        $this->checkDriverRole($driver);

        $this->driverService->revokeDriverRole($driver);

        return redirect()->route('admin.drivers.index')
                         ->with('success', 'تم إزالة المندوب ورده كعميل عادي بنجاح');
    }

    private function checkDriverRole(User $user): void
    {
        if ($user->role !== 'driver') {
            abort(404);
        }
    }
}