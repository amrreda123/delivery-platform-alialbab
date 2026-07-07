@extends('layouts.admin')

@section('title', 'تفاصيل الطلب #' . $order->id)
@section('page-title', 'تفاصيل الطلب #' . $order->id)
@section('page-subtitle', 'عرض تفاصيل الطلب وتحديث حالته')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Order Details Card -->
    <div class="lg:col-span-2 space-y-6">
        <div class="glass-card p-6" data-aos="fade-up">
            <h3 class="text-lg font-bold text-[#0B1536] mb-4 border-b pb-3">معلومات الطلب</h3>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <span class="text-sm font-semibold text-gray-500">نوع الطلب</span>
                    <span class="text-sm font-bold text-gray-800">
                        {{ $order->order_type == 'store_order' ? 'طلب من متجر' : 'طلب خاص / منوع' }}
                    </span>
                </div>

                @if($order->order_type == 'store_order' && $order->store)
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <span class="text-sm font-semibold text-gray-500">المتجر</span>
                    <span class="text-sm font-bold text-blue-600">{{ $order->store->name }}</span>
                </div>
                @elseif($order->order_type == 'custom_order')
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <span class="text-sm font-semibold text-gray-500">عنوان الاستلام (متجر مخصص)</span>
                    <span class="text-sm font-bold text-gray-800">{{ $order->pickup_address }}</span>
                </div>
                @endif

                <div class="bg-gray-50 p-4 rounded-lg">
                    <span class="block text-sm font-semibold text-gray-500 mb-2">الطلبات / الملاحظات</span>
                    <p class="text-sm font-medium text-gray-800 whitespace-pre-line">{{ $order->notes }}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <span class="block text-sm font-semibold text-gray-500 mb-2">عنوان التوصيل (للعميل)</span>
                    <p class="text-sm font-medium text-gray-800">{{ $order->dropoff_address }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Cards -->
    <div class="space-y-6">
        
        <!-- Status Update Card -->
        <div class="glass-card p-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-lg font-bold text-[#0B1536] mb-4 border-b pb-3">حالة الطلب</h3>
            
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-500 mb-2">تحديث الحالة</label>
                    <select name="status" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] outline-none font-bold">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                        <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>تم القبول</option>
                        <option value="on_the_way" {{ $order->status == 'on_the_way' ? 'selected' : '' }}>في الطريق</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>تم التوصيل</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-500 mb-2">تعيين مندوب التوصيل</label>
                    <select name="driver_id" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] outline-none font-bold">
                        <option value="">بدون مندوب</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ $order->driver_id == $driver->id ? 'selected' : '' }}>
                                {{ $driver->name }} ({{ $driver->phone }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="w-full bg-[#0B1536] text-white font-bold rounded-xl px-4 py-3 hover:bg-blue-900 transition-colors">
                    حفظ التعديلات
                </button>
            </form>
        </div>

        <!-- Customer Info Card -->
        <div class="glass-card p-6" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-lg font-bold text-[#0B1536] mb-4 border-b pb-3">بيانات العميل</h3>
            
            <div class="space-y-3">
                <div>
                    <span class="block text-xs font-semibold text-gray-400">الاسم</span>
                    <span class="block text-sm font-bold text-gray-800">{{ $order->customer->name ?? 'غير متوفر' }}</span>
                </div>
                <div>
                    <span class="block text-xs font-semibold text-gray-400">رقم الهاتف</span>
                    <span class="block text-sm font-bold text-gray-800" dir="ltr">{{ $order->customer->phone ?? 'غير متوفر' }}</span>
                    @if($order->customer && $order->customer->phone)
                        <a href="https://wa.me/2{{ $order->customer->phone }}" target="_blank" class="mt-2 inline-flex items-center justify-center w-full bg-green-500 text-white font-bold rounded-lg px-3 py-2 text-xs hover:bg-green-600 transition-colors">
                            مراسلة واتساب
                        </a>
                    @endif
                </div>
                <div>
                    <span class="block text-xs font-semibold text-gray-400">تاريخ الطلب</span>
                    <span class="block text-sm font-bold text-gray-800" dir="ltr">{{ $order->created_at->format('Y-m-d h:i A') }}</span>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
