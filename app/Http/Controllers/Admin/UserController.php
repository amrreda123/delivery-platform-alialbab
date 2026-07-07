<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {}

    public function index()
    {
        $users = $this->userService->getPaginatedCustomers();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->createCustomer($request->validated());

        return redirect()->route('admin.users.index')->with('success', 'تم إضافة العميل بنجاح');
    }

    public function show(User $user)
    {
        $this->checkCustomerRole($user);
        
        $orders = \App\Models\Order::where('user_id', $user->id)->with(['store', 'driver'])->latest()->paginate(15);
        
        $totalOrders = \App\Models\Order::where('user_id', $user->id)->count();
        // Calculate total delivery fees spent by customer (only for delivered orders)
        $totalSpent = \App\Models\Order::where('user_id', $user->id)->where('status', 'delivered')->sum('delivery_fee');

        return view('admin.users.show', compact('user', 'orders', 'totalOrders', 'totalSpent'));
    }

    public function edit(User $user)
    {
        $this->checkCustomerRole($user);
        
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->checkCustomerRole($user);

        $this->userService->updateCustomerStatus($user, $request->validated());

        return redirect()->route('admin.users.index')->with('success', 'تم تعديل حالة العميل بنجاح');
    }

    public function destroy(User $user)
    {
        $this->checkCustomerRole($user);

        $this->userService->deleteCustomer($user);
        
        return redirect()->route('admin.users.index')->with('success', 'تم حذف العميل بنجاح');
    }

    private function checkCustomerRole(User $user): void
    {
        if ($user->role !== 'customer') {
            abort(404);
        }
    }
}
