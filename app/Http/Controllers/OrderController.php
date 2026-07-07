<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Services\OrderService;
use App\Http\Requests\StoreCustomerOrderRequest;
use App\Models\DeliveryArea;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService
    ) {}

    public function create(Category $category)
    {
        $stores = $category->stores()->where('is_active', true)->get();
        $deliveryAreas = DeliveryArea::where('is_active', true)->get();
        return view('order.create', compact('category', 'stores', 'deliveryAreas'));
    }

    public function store(StoreCustomerOrderRequest $request, Category $category)
    {
        $whatsappLink = $this->orderService->createCustomerOrder($category, $request->validated());

        // Optional: you can flash success message so if they come back they see it, but we redirect away.
        session()->flash('success', 'تم تسجيل طلبك بنجاح. جاري تحويلك لواتساب لتأكيد الطلب.');

        return redirect()->away($whatsappLink);
    }
}
