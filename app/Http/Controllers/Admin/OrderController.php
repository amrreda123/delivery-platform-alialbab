<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use App\Http\Requests\Admin\UpdateOrderRequest;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService
    ) {}

    public function index()
    {
        $orders = $this->orderService->getPaginatedAdminOrders();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'driver', 'store', 'dropoffAddress']);
        $drivers = User::where('role', 'driver')->where('is_active', true)->get();
        return view('admin.orders.show', compact('order', 'drivers'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->orderService->updateAdminOrder($order, $request->validated());

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }
}
