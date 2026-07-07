<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\DeliveryArea;
use App\Models\Address;
use App\Models\Store;

class OrderService
{
    public function getPaginatedAdminOrders(int $perPage = 15)
    {
        return Order::with(['customer', 'store', 'driver'])->latest()->paginate($perPage);
    }

    public function updateAdminOrder(Order $order, array $data): void
    {
        $updateData = ['status' => $data['status']];
        
        if (array_key_exists('driver_id', $data)) {
            $updateData['driver_id'] = $data['driver_id'];
        }

        if (isset($data['items_total'])) {
            $updateData['items_total'] = $data['items_total'];
        }

        if (isset($data['delivery_fee'])) {
            $updateData['delivery_fee'] = $data['delivery_fee'];
        }

        // حساب الإجمالي الجديد
        $itemsTotal = $updateData['items_total'] ?? $order->items_total;
        $deliveryFee = $updateData['delivery_fee'] ?? $order->delivery_fee;
        $updateData['total_amount'] = $itemsTotal + $deliveryFee;

        $order->update($updateData);
    }

    public function createCustomerOrder(Category $category, array $data)
    {
        $user = User::firstOrCreate(
            ['phone' => $data['customer_phone']],
            [
                'name' => $data['customer_name'],
                'password' => bcrypt('password'),
                'role' => 'customer'
            ]
        );

        $orderType = !empty($data['store_id']) ? 'store_order' : 'custom_order';

        $addressId = null;
        $fullDropoffAddress = $data['dropoff_address'];
        $deliveryFee = 0;

        if (!empty($data['delivery_area_id']) && $data['delivery_area_id'] !== 'other') {
            $area = DeliveryArea::find($data['delivery_area_id']);
            if ($area) {
                $deliveryFee = $area->delivery_fee;
                $fullDropoffAddress = $area->name . ' - ' . $data['dropoff_address'];
                
                $address = Address::firstOrCreate([
                    'user_id' => $user->id,
                    'delivery_area_id' => $area->id,
                    'address_text' => $data['dropoff_address'],
                ]);
                $addressId = $address->id;
            }
        } else {
            $address = Address::firstOrCreate([
                'user_id' => $user->id,
                'address_text' => $data['dropoff_address'],
            ]);
            $addressId = $address->id;
        }

        $order = Order::create([
            'user_id' => $user->id,
            'store_id' => $data['store_id'] ?? null,
            'order_type' => $orderType,
            'pickup_address' => $data['pickup_address'] ?? null,
            'notes' => $data['notes'],
            'address_id' => $addressId,
            'dropoff_address' => $fullDropoffAddress,
            'delivery_fee' => $deliveryFee,
            'total_amount' => $deliveryFee, // مبدئياً الإجمالي هو سعر التوصيل لحد ما الأدمن يضيف ثمن الطلبات
            'status' => 'pending'
        ]);

        return $this->generateWhatsAppLink($category, $order, $user, $data, $orderType, $fullDropoffAddress);
    }

    private function generateWhatsAppLink(Category $category, Order $order, User $user, array $data, string $orderType, string $fullDropoffAddress): string
    {
        $storeName = 'متجر غير محدد';
        if ($orderType == 'store_order' && !empty($data['store_id'])) {
            $store = Store::find($data['store_id']);
            $storeName = $store ? $store->name : 'متجر غير محدد';
        } else {
            $storeName = $data['pickup_address'] ?? 'غير محدد';
        }

        $message = "مرحباً، لدي طلب جديد:\n";
        $message .= "----------------------\n";
        $message .= "القسم: " . $category->name . "\n";
        $message .= "المتجر / الاستلام: " . $storeName . "\n";
        $message .= "الاسم: " . $user->name . "\n";
        $message .= "الموبايل: " . $user->phone . "\n";
        $message .= "----------------------\n";
        $message .= "الطلبات والملاحظات:\n" . $data['notes'] . "\n";
        $message .= "----------------------\n";
        $message .= "العنوان: " . $fullDropoffAddress . "\n";
        $message .= "رقم الطلب: #" . $order->id;

        $whatsappNumber = "201140382833";
        return "https://wa.me/" . $whatsappNumber . "?text=" . urlencode($message);
    }
}
