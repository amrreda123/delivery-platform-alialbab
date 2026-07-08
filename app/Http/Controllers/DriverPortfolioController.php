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

    public function settings()
    {
        $user = Auth::user();
        return view('driver.settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:50|min:3',
            'password' => 'nullable|string|min:8|confirmed',
            'vehicle_type' => 'required|in:motorcycle,car,bicycle,van',
            'is_available' => 'boolean',
        ]);

        // Update User info
        $user->name = $request->name;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        // Update or Create Driver Profile
        $user->driverProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'vehicle_type' => $request->vehicle_type,
                'is_available' => $request->boolean('is_available'),
            ]
        );

        return back()->with('success', 'تم تحديث بياناتك بنجاح.');
    }
}
