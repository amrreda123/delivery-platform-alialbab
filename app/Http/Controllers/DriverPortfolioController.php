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
}
