<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Category $category)
    {
        $stores = $category->stores()->where('is_active', true)->get();
        $deliveryAreas = \App\Models\DeliveryArea::where('is_active', true)->get();
        return view('order.create', compact('category', 'stores', 'deliveryAreas'));
    }

    public function store(Request $request, Category $category)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'store_id' => 'nullable|exists:stores,id',
            'pickup_address' => 'nullable|string',
            'notes' => 'required|string',
            'delivery_area_id' => 'nullable',
            'dropoff_address' => 'required|string',
        ]);

        if (empty($validated['store_id']) && empty($validated['pickup_address'])) {
            return back()->withErrors(['pickup_address' => 'يرجى تحديد متجر أو كتابة عنوان المتجر.'])->withInput();
        }

        $user = User::firstOrCreate(
            ['phone' => $validated['customer_phone']],
            [
                'name' => $validated['customer_name'],
                'password' => bcrypt('password'),
                'role' => 'customer'
            ]
        );

        $orderType = !empty($validated['store_id']) ? 'store_order' : 'custom_order';

        $addressId = null;
        $fullDropoffAddress = $validated['dropoff_address'];

        if (!empty($validated['delivery_area_id']) && $validated['delivery_area_id'] !== 'other') {
            $area = \App\Models\DeliveryArea::find($validated['delivery_area_id']);
            if ($area) {
                $fullDropoffAddress = $area->name . ' - ' . $validated['dropoff_address'];
                
                // Create or find address record
                $address = \App\Models\Address::firstOrCreate([
                    'user_id' => $user->id,
                    'delivery_area_id' => $area->id,
                    'address_text' => $validated['dropoff_address'],
                ]);
                $addressId = $address->id;
            }
        } else {
            $address = \App\Models\Address::firstOrCreate([
                'user_id' => $user->id,
                'address_text' => $validated['dropoff_address'],
            ]);
            $addressId = $address->id;
        }

        $order = Order::create([
            'user_id' => $user->id,
            'store_id' => $validated['store_id'] ?? null,
            'order_type' => $orderType,
            'pickup_address' => $validated['pickup_address'] ?? null,
            'notes' => $validated['notes'],
            'address_id' => $addressId,
            'dropoff_address' => $fullDropoffAddress,
            'status' => 'pending'
        ]);

        $storeName = 'متجر غير محدد';
        if ($orderType == 'store_order' && !empty($validated['store_id'])) {
            $store = \App\Models\Store::find($validated['store_id']);
            $storeName = $store ? $store->name : 'متجر غير محدد';
        } else {
            $storeName = $validated['pickup_address'] ?? 'غير محدد';
        }

        $message = "مرحباً، لدي طلب جديد:\n";
        $message .= "----------------------\n";
        $message .= "القسم: " . $category->name . "\n";
        $message .= "المتجر / الاستلام: " . $storeName . "\n";
        $message .= "الاسم: " . $user->name . "\n";
        $message .= "الموبايل: " . $user->phone . "\n";
        $message .= "----------------------\n";
        $message .= "الطلبات والملاحظات:\n" . $validated['notes'] . "\n";
        $message .= "----------------------\n";
        $message .= "العنوان: " . $fullDropoffAddress . "\n";
        $message .= "رقم الطلب: #" . $order->id;

        $whatsappNumber = "201140382833";
        $whatsappLink = "https://wa.me/" . $whatsappNumber . "?text=" . urlencode($message);

        // Optional: you can flash success message so if they come back they see it, but we redirect away.
        session()->flash('success', 'تم تسجيل طلبك بنجاح. جاري تحويلك لواتساب لتأكيد الطلب.');

        return redirect()->away($whatsappLink);
    }
}
