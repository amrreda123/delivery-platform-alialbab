<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'store', 'driver'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'driver', 'store', 'dropoffAddress']);
        $drivers = User::where('role', 'driver')->where('is_active', true)->get();
        return view('admin.orders.show', compact('order', 'drivers'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,on_the_way,delivered',
            'driver_id' => 'nullable|exists:users,id'
        ]);

        $order->update([
            'status' => $request->status,
            'driver_id' => $request->driver_id
        ]);

        return back()->with('success', 'تم تحديث الطلب بنجاح.');
    }
}
