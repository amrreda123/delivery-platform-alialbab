<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $orders = Order::where('user_id', $user->id)
            ->with(['store', 'driver'])
            ->latest()
            ->get();

        return view('profile', compact('orders', 'user'));
    }

    public function settings()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.settings.edit');
        }

        return view('profile-settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:50|min:3',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'تم تحديث بيانات الحساب بنجاح.');
    }
}
