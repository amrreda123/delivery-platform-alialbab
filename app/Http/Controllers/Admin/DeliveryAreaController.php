<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliveryAreaRequest;
use App\Models\DeliveryArea;
use App\Services\DeliveryAreaService;

class DeliveryAreaController extends Controller
{
    public function __construct(private DeliveryAreaService $deliveryAreaService)
    {
    }

    public function index()
    {
        $deliveryAreas = $this->deliveryAreaService->getAllAreas();
        return view('admin.delivery_areas.index', compact('deliveryAreas'));
    }

    public function create()
    {
        return view('admin.delivery_areas.create');
    }

    public function store(DeliveryAreaRequest $request)
    {
        $this->deliveryAreaService->createArea($request->validated());

        return redirect()->route('admin.delivery-areas.index')
                         ->with('success', 'تم إضافة منطقة التوصيل بنجاح!');
    }

    public function edit(DeliveryArea $deliveryArea)
    {
        return view('admin.delivery_areas.edit', compact('deliveryArea'));
    }

    public function update(DeliveryAreaRequest $request, DeliveryArea $deliveryArea)
    {
        $this->deliveryAreaService->updateArea($deliveryArea, $request->validated());

        return redirect()->route('admin.delivery-areas.index')
                         ->with('success', 'تم تحديث منطقة التوصيل بنجاح!');
    }

    public function destroy(DeliveryArea $deliveryArea)
    {
        $this->deliveryAreaService->deleteArea($deliveryArea);

        return redirect()->route('admin.delivery-areas.index')
                         ->with('success', 'تم حذف منطقة التوصيل بنجاح!');
    }
}
