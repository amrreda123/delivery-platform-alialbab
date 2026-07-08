@extends('layouts.admin')

@section('title', 'إدارة الطلبات')
@section('page-title', 'الطلبات')
@section('page-subtitle', 'عرض وإدارة جميع طلبات العملاء')

@section('content')
<div class="glass-card p-6" data-aos="fade-up">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-[#0B1536]">قائمة الطلبات</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-right whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm"># الطلب</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">العميل</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">المندوب</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">المتجر / نوع الطلب</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">الحالة</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">التاريخ</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm text-center">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-4 py-3">
                        <div class="text-sm font-bold text-[#0B1536]">#{{ $order->id }}</div>
                        <div class="text-xs text-gray-500 mt-1 font-mono" dir="ltr" title="كود التتبع">{{ $order->tracking_code }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="text-sm font-semibold text-gray-800">{{ $order->customer->name ?? 'غير معروف' }}</div>
                        <div class="text-xs text-gray-500">{{ $order->customer->phone ?? '' }}</div>
                    </td>
                    <td class="px-4 py-3">
                        @if($order->driver)
                            <div class="text-sm font-bold text-gray-800">{{ $order->driver->name }}</div>
                        @else
                            <span class="text-xs text-gray-400">غير معين</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">
                        @if($order->order_type == 'store_order')
                            <span class="text-blue-600 font-semibold">{{ $order->store->name ?? 'متجر محذوف' }}</span>
                        @else
                            <span class="text-purple-600 font-semibold">طلب خاص / منوع</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if($order->status == 'pending')
                            <span class="px-2 py-1 text-xs font-semibold rounded-lg bg-yellow-100 text-yellow-800">قيد الانتظار</span>
                        @elseif($order->status == 'accepted')
                            <span class="px-2 py-1 text-xs font-semibold rounded-lg bg-blue-100 text-blue-800">تم القبول</span>
                        @elseif($order->status == 'on_the_way')
                            <span class="px-2 py-1 text-xs font-semibold rounded-lg bg-orange-100 text-orange-800">في الطريق</span>
                        @elseif($order->status == 'delivered')
                            <span class="px-2 py-1 text-xs font-semibold rounded-lg bg-green-100 text-green-800">تم التوصيل</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-500" dir="ltr">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">لا توجد طلبات حتى الآن.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
