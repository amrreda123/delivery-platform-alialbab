@extends('layouts.admin')

@section('title', 'تفاصيل العميل: ' . $user->name)
@section('page-title', 'ملف العميل')
@section('page-subtitle', 'عرض تفاصيل وسجل طلبات العميل')

@section('content')
<div class="space-y-6">
    <!-- Customer Info & Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Customer Profile -->
        <div class="glass-card p-6 flex items-center gap-4 border-r-4 border-[#0B1536]">
            <div class="w-16 h-16 rounded-2xl bg-[#0B1536] flex items-center justify-center text-[#FFC107] text-2xl font-black shadow-lg">
                {{ mb_substr($user->name, 0, 1) }}
            </div>
            <div>
                <h3 class="text-xl font-bold text-[#0B1536]">{{ $user->name }}</h3>
                <div class="text-sm text-gray-500 mt-1 flex items-center gap-1" dir="ltr">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ $user->phone }}
                </div>
            </div>
        </div>

        <!-- Action Card -->
        <div class="glass-card p-6 flex flex-col justify-center gap-3 border-r-4 border-[#FFC107]">
            <h4 class="text-sm font-semibold text-gray-500 mb-2">إجراءات إضافية</h4>
            <form id="convert-form" action="{{ route('admin.users.convert-to-driver', $user->id) }}" method="POST">
                @csrf
                <button type="button" onclick="confirmConvert()" class="w-full flex items-center justify-center gap-2 bg-[#0B1536] text-white font-bold rounded-xl px-4 py-3 hover:bg-blue-900 transition-colors shadow-lg shadow-blue-900/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    ترقية العميل إلى "مندوب توصيل"
                </button>
            </form>
        </div>

        <!-- Total Orders Stat -->
        <div class="glass-card p-6 flex items-center gap-4 border-r-4 border-blue-500">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-1">إجمالي الطلبات</p>
                <h4 class="text-2xl font-black text-[#0B1536]">{{ $totalOrders }} <span class="text-sm font-medium text-gray-400">طلب</span></h4>
            </div>
        </div>

        <!-- Total Spent Stat -->
        <div class="glass-card p-6 flex items-center gap-4 border-r-4 border-emerald-500">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08-.402-2.599-1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-1">إجمالي رسوم التوصيل المدفوعة</p>
                <h4 class="text-2xl font-black text-[#0B1536]">{{ number_format($totalSpent, 2) }} <span class="text-sm font-medium text-gray-400">ج.م</span></h4>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="glass-card p-6" data-aos="fade-up">
        <h3 class="text-xl font-bold text-[#0B1536] mb-6">سجل طلبات العميل</h3>
        
        <div class="overflow-x-auto">
            <table class="w-full text-right whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-4 py-3 font-semibold text-gray-500 text-sm rounded-r-xl">رقم الطلب</th>
                        <th class="px-4 py-3 font-semibold text-gray-500 text-sm">المتجر / الاستلام</th>
                        <th class="px-4 py-3 font-semibold text-gray-500 text-sm">المندوب</th>
                        <th class="px-4 py-3 font-semibold text-gray-500 text-sm">الإجمالي</th>
                        <th class="px-4 py-3 font-semibold text-gray-500 text-sm">الحالة</th>
                        <th class="px-4 py-3 font-semibold text-gray-500 text-sm">التاريخ</th>
                        <th class="px-4 py-3 font-semibold text-gray-500 text-sm rounded-l-xl text-center">إجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-3">
                            <div class="font-bold text-[#0B1536]">#{{ $order->id }}</div>
                            <div class="text-xs text-gray-500 mt-1 font-mono" dir="ltr" title="كود التتبع">{{ $order->tracking_code }}</div>
                        </td>
                        <td class="px-4 py-3">
                            @if($order->order_type == 'store_order' && $order->store)
                                <span class="text-sm font-bold text-blue-600">{{ $order->store->name }}</span>
                            @else
                                <span class="text-sm font-medium text-gray-600">طلب خاص</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($order->driver)
                                <div class="font-semibold text-gray-800">{{ $order->driver->name }}</div>
                            @else
                                <span class="text-xs text-gray-400">لم يتم التعيين</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-bold text-emerald-600">{{ number_format($order->total_amount, 2) }} ج.م</span>
                        </td>
                        <td class="px-4 py-3">
                            @if($order->status == 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold border border-yellow-200">قيد الانتظار</span>
                            @elseif($order->status == 'accepted')
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold border border-blue-200">تم القبول</span>
                            @elseif($order->status == 'on_the_way')
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold border border-purple-200">في الطريق</span>
                            @elseif($order->status == 'delivered')
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold border border-green-200">تم التوصيل</span>
                            @elseif($order->status == 'cancelled')
                                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold border border-red-200">ملغي</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-bold border border-gray-200">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500" dir="ltr">
                            {{ $order->created_at->format('Y-m-d H:i') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors" title="عرض الطلب">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500 font-semibold">لم يقم هذا العميل بإجراء أي طلبات حتى الآن.</td>
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
</div>

<script>
function confirmConvert() {
    Swal.fire({
        title: 'ترقية الحساب؟',
        text: "هل أنت متأكد من تحويل هذا العميل إلى مندوب توصيل؟ سيتم إنشاء ملف مندوب جديد له فوراً.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0B1536',
        cancelButtonColor: '#9ca3af',
        confirmButtonText: 'نعم، قم بالترقية',
        cancelButtonText: 'إلغاء',
        customClass: {
            popup: 'rounded-3xl',
            confirmButton: 'rounded-xl font-bold px-6 py-2.5',
            cancelButton: 'rounded-xl font-bold px-6 py-2.5'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('convert-form').submit();
        }
    })
}
</script>
@endsection
