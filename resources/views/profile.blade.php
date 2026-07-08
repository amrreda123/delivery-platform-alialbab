@extends('layouts.app')

@section('content')

<!-- Hero Section for Tracking -->
<div class="bg-[#0B1536] py-16 text-center text-white relative">

    <!-- Logout Button -->
    <div class="absolute top-6 left-6">
        <form action="{{ route('customer.logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                تسجيل الخروج
            </button>
        </form>
    </div>

    <!-- Settings Button Removed per user request -->

    <h1 class="text-4xl font-black mb-4">أهلاً بك، {{ $user->name }} 👋</h1>
    <p class="text-gray-300 max-w-lg mx-auto mb-10">هنا يمكنك متابعة حالة طلباتك الحالية ومراجعة سجل طلباتك السابقة.</p>
</div>

<div class="max-w-4xl mx-auto px-6 py-12">

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded-lg shadow-sm flex items-center gap-3">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-green-700 font-bold text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Results Section -->
    @if(isset($orders))
        <h2 class="text-2xl font-black text-[#0B1536] mb-6 border-r-4 border-[#FFC107] pr-3">سجل طلباتك</h2>
        
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4 pb-4 border-b border-gray-50">
                        <div>
                            <span class="text-sm text-gray-500 font-bold mb-1 block">رقم الطلب #{{ $order->id }}</span>
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg font-black text-[#0B1536]">
                                    {{ $order->order_type == 'store_order' ? ($order->store->name ?? 'متجر محذوف') : 'طلب مخصص (أغراض)' }}
                                </h3>
                                <span class="px-3 py-1 rounded-full text-xs font-bold 
                                    @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($order->status == 'accepted') bg-blue-100 text-blue-700
                                    @elseif($order->status == 'picked_up') bg-purple-100 text-purple-700
                                    @elseif($order->status == 'delivered') bg-green-100 text-green-700
                                    @elseif($order->status == 'cancelled') bg-red-100 text-red-700
                                    @endif">
                                    @if($order->status == 'pending') قيد المراجعة 🕒
                                    @elseif($order->status == 'accepted') جاري التجهيز 👨‍🍳
                                    @elseif($order->status == 'picked_up') مع المندوب 🛵
                                    @elseif($order->status == 'delivered') مكتمل ✅
                                    @elseif($order->status == 'cancelled') ملغي ❌
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="text-left">
                            <span class="block text-xl font-black text-emerald-600">{{ $order->total_amount }} ج.م</span>
                            <span class="text-xs text-gray-400">{{ $order->created_at->format('Y-m-d h:i A') }}</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div>
                                <span class="block text-gray-400 text-xs font-bold">مكان التوصيل</span>
                                <span class="text-gray-700">{{ $order->dropoff_address }}</span>
                            </div>
                        </div>
                        
                        @if($order->driver)
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <span class="block text-gray-400 text-xs font-bold">المندوب</span>
                                <span class="text-gray-700">{{ $order->driver->name }} - {{ $order->driver->phone }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
