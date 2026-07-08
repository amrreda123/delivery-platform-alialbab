<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DriverPortfolioController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ensure only drivers can access this
        if ($user->role !== 'driver') {
            abort(403, 'Unauthorized action.');
        }

        // Get orders assigned to this driver
        $orders = Order::where('driver_id', $user->id)
            ->with(['store', 'customer']) // customer relation from Order model
            ->latest()
            ->paginate(15);

        // Also get some stats for the driver
        $totalAssigned = Order::where('driver_id', $user->id)->count();
        $totalDelivered = Order::where('driver_id', $user->id)->where('status', 'delivered')->count();
        $totalEarnings = Order::where('driver_id', $user->id)->where('status', 'delivered')->sum('delivery_fee');

        return view('driver.portfolio', compact('orders', 'user', 'totalAssigned', 'totalDelivered', 'totalEarnings'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $user = Auth::user();

        // Ensure only drivers can access this
        if ($user->role !== 'driver') {
            abort(403, 'Unauthorized action.');
        }

        // Ensure the driver is assigned to this order
        if ($order->driver_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:pending,accepted,on_the_way,delivered'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }

    public function printOrder(Order $order)
    {
        $user = Auth::user();

        // Ensure only drivers can access this
        if ($user->role !== 'driver') {
            abort(403, 'Unauthorized action.');
        }

        // Ensure the driver is assigned to this order
        if ($order->driver_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('driver.print', compact('order'));
    }
}
