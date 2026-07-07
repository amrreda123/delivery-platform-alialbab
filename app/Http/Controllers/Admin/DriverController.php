<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = User::where('role', 'driver')->latest()->paginate(15);
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:6',
            'is_active' => 'boolean',
        ]);

        User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'password' => bcrypt($validated['password']),
            'role' => 'driver',
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.drivers.index')->with('success', 'تم إضافة المندوب بنجاح');
    }

    public function edit(User $driver)
    {
        if ($driver->role !== 'driver') {
            abort(404);
        }
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, User $driver)
    {
        if ($driver->role !== 'driver') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($driver->id)],
            'password' => 'nullable|string|min:6',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'is_active' => $request->has('is_active'),
        ];

        if (!empty($validated['password'])) {
            $data['password'] = bcrypt($validated['password']);
        }

        $driver->update($data);

        return redirect()->route('admin.drivers.index')->with('success', 'تم تعديل بيانات المندوب بنجاح');
    }

    public function destroy(User $driver)
    {
        if ($driver->role !== 'driver') {
            abort(404);
        }
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'تم حذف المندوب بنجاح');
    }
}
