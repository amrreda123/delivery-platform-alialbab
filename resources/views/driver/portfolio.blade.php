@extends('layouts.app')

@section('content')

<!-- Hero Section for Driver Portfolio -->
<div class="bg-[#0B1536] py-16 text-center text-white relative">
    <div class="absolute top-6 left-6">
        <form method="POST" action="{{ route('customer.logout') }}">
            @csrf
            <button type="submit" class="bg-red-500/20 hover:bg-red-500/40 text-red-100 px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                تسجيل الخروج
            </button>
        </form>
    </div>

    <h1 class="text-4xl font-black mb-4">بوابة المندوب 🛵</h1>
    <p class="text-gray-300 max-w-lg mx-auto mb-6">مرحباً بك يا {{ explode(' ', $user->name)[0] }}! تابع طلباتك، وإحصائياتك من هنا.</p>

    <!-- Stats Cards -->
    <div class="flex flex-wrap justify-center gap-4 mt-8 px-4">
        <div class="bg-white/10 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/10 flex items-center gap-4 w-full md:w-auto">
            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center text-blue-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-300 font-bold">إجمالي الطلبات المستلمة</p>
                <p class="text-2xl font-black">{{ $totalAssigned }}</p>
            </div>
        </div>
        
        <div class="bg-white/10 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/10 flex items-center gap-4 w-full md:w-auto">
            <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center text-emerald-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-300 font-bold">الطلبات المكتملة</p>
                <p class="text-2xl font-black">{{ $totalDelivered }}</p>
            </div>
        </div>
        
        <div class="bg-white/10 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/10 flex items-center gap-4 w-full md:w-auto">
            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center text-[#FFC107]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-300 font-bold">إجمالي رسوم التوصيل</p>
                <p class="text-2xl font-black">{{ number_format($totalEarnings, 2) }} <span class="text-sm">ج.م</span></p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-black text-[#0B1536]">الطلبات المكلف بها</h2>
    </div>

    @if($orders->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($orders as $order)
            <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 hover:shadow-lg transition">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-[#0B1536] font-bold text-lg border border-gray-100">
                            #{{ $order->id }}
                        </div>
                        <div>
                            <h3 class="font-bold text-[#0B1536]">{{ $order->store->name ?? 'طلب عام' }}</h3>
                            <p class="text-sm text-gray-500">{{ $order->created_at->translatedFormat('d M Y - h:i A') }}</p>
                        </div>
                    </div>
                    
                    <!-- Status Badge and Update Form -->
                    <div class="flex flex-col items-end gap-2">
                        @if($order->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1.5 rounded-lg">قيد الانتظار</span>
                        @elseif($order->status == 'accepted')
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1.5 rounded-lg">تم القبول</span>
                        @elseif($order->status == 'on_the_way')
                            <span class="bg-purple-100 text-purple-800 text-xs font-bold px-3 py-1.5 rounded-lg border border-purple-200">في الطريق</span>
                        @elseif($order->status == 'delivered')
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1.5 rounded-lg">مكتمل</span>
                        @elseif($order->status == 'cancelled')
                            <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1.5 rounded-lg">ملغي</span>
                        @endif

                        <!-- Driver Status Update Form -->
                        @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                        <form action="{{ route('driver.portfolio.update-status', $order->id) }}" method="POST" class="flex items-center gap-1 mt-1">
                            @csrf
                            @method('PUT')
                            <select name="status" class="text-xs bg-gray-50 border border-gray-200 rounded-lg px-2 py-1 font-bold text-gray-700 outline-none focus:border-[#FFC107]">
                                <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>تم القبول</option>
                                <option value="on_the_way" {{ $order->status == 'on_the_way' ? 'selected' : '' }}>في الطريق</option>
                                <option value="delivered">مكتمل (تم التوصيل)</option>
                            </select>
                            <button type="submit" class="bg-[#0B1536] text-white p-1 rounded-lg hover:bg-gray-800 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

                <hr class="border-gray-50 my-4">

                <div class="space-y-3 mb-5">
                    <!-- Customer details -->
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <div>
                            <p class="text-sm font-semibold text-gray-700">العميل: {{ $order->customer->name ?? 'غير متوفر' }}</p>
                            <p class="text-xs font-bold text-[#FFC107]">{{ $order->customer->phone ?? 'غير متوفر' }}</p>
                        </div>
                    </div>

                    <!-- Dropoff Details -->
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">{{ $order->dropoff_address }}</p>
                            @if($order->notes)
                                <p class="text-xs text-red-500 mt-1 font-bold flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> ملاحظات: {{ $order->notes }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-4 space-y-3">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 font-bold">ثمن المشتريات:</span>
                        <span class="font-bold text-gray-800">{{ number_format($order->items_total, 2) }} ج.م</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 font-bold">رسوم التوصيل (نصيبك):</span>
                        <span class="font-bold text-green-600">{{ number_format($order->delivery_fee, 2) }} ج.م</span>
                    </div>
                    <hr class="border-gray-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="block text-sm text-[#0B1536] font-bold">المبلغ المطلوب تحصيله من العميل</span>
                            <span class="block text-xs text-gray-400 font-bold mt-0.5">(المشتريات + التوصيل)</span>
                        </div>
                        <span class="text-xl font-black text-[#0B1536]">{{ number_format($order->total_amount, 2) }} ج.م</span>
                    </div>
                </div>

                <!-- Print Button -->
                <div class="mt-4 text-center">
                    <a href="{{ route('driver.portfolio.print-order', $order->id) }}" target="_blank" class="inline-flex items-center justify-center gap-2 w-full md:w-auto bg-gray-800 hover:bg-black text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        طباعة الفاتورة PDF
                    </a>
                </div>
                
            </div>
            @endforeach
        </div>

        @if($orders->hasPages())
        <div class="mt-10">
            {{ $orders->links() }}
        </div>
        @endif
    @else
        <div class="text-center py-20 bg-white rounded-3xl border border-gray-100 shadow-sm">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-[#0B1536] mb-2">لا توجد طلبات مكلف بها بعد</h3>
            <p class="text-gray-500">عندما يتم تكليفك بطلبات من قبل الإدارة، ستظهر جميع تفاصيلها هنا.</p>
        </div>
    @endif
</div>

@endsection
