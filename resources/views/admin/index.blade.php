@extends('layouts.admin')

@section('title', 'لوحة التحكم')
@section('page-title', 'لوحة التحكم')
@section('page-subtitle', 'نظرة شاملة على أداء منصة علي الباب')

@section('content')

<style>
    @keyframes countUp {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes progressFill {
        from { width: 0%; }
        to   { width: var(--target-width); }
    }
    .progress-bar {
        animation: progressFill 1.5s cubic-bezier(0.4,0,0.2,1) both;
        width: var(--target-width);
    }
    @keyframes ripple {
        0%   { transform: scale(1); opacity: 1; }
        100% { transform: scale(2.5); opacity: 0; }
    }
    .progress-bar { animation: progressFill 1.5s cubic-bezier(0.4,0,0.2,1) both; }
    .ripple-btn::after {
        content: '';
        position: absolute; inset: 0;
        border-radius: inherit;
        background: rgba(255,255,255,0.3);
        transform: scale(0);
        transition: transform 0.6s, opacity 0.6s;
        opacity: 0;
    }
    .ripple-btn:active::after { transform: scale(2); opacity: 0; }

    .card-shine {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.05) 50%, rgba(255,255,255,0) 100%);
        pointer-events: none;
        border-radius: inherit;
    }
    .metric-icon {
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .kpi-card:hover .metric-icon {
        transform: scale(1.15) rotate(-5deg);
    }
</style>

{{-- ====== WELCOME BANNER ====== --}}
<div class="relative overflow-hidden rounded-3xl mb-7 p-7" style="background: linear-gradient(135deg, #0B1536 0%, #1a2a5e 50%, #111f4d 100%);">
    {{-- Decorative blobs --}}
    <div class="absolute -top-10 -left-10 w-48 h-48 rounded-full opacity-10" style="background: radial-gradient(circle, #FFC107, transparent 70%);"></div>
    <div class="absolute -bottom-8 left-32 w-32 h-32 rounded-full opacity-10" style="background: radial-gradient(circle, #6366F1, transparent 70%);"></div>
    <div class="absolute top-4 left-1/2 w-20 h-20 rounded-full opacity-5" style="background: radial-gradient(circle, #FFC107, transparent);"></div>

    <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-5">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                <span class="text-emerald-300 text-xs font-semibold">النظام يعمل بكفاءة 100%</span>
            </div>
            <h2 class="text-white font-black text-2xl md:text-3xl mb-1">مرحباً بك مجدداً! 👋</h2>
            <p class="text-white/50 text-sm">لوحة إدارة منصة <span class="text-[#FFC107] font-bold">علي الباب</span> - {{ now()->format('l، d F Y') }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.settings.edit') }}" class="ripple-btn relative flex items-center gap-2 bg-[#FFC107] hover:bg-yellow-400 text-[#0B1536] px-5 py-2.5 rounded-xl font-black text-sm transition-all duration-200 hover:shadow-lg hover:shadow-yellow-500/30 hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                الإعدادات
            </a>
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all duration-200 border border-white/10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                الموقع
            </a>
        </div>
    </div>
</div>

{{-- ====== KPI CARDS ====== --}}
<div class="grid grid-cols-2 xl:grid-cols-4 gap-5 mb-7">

    @php
        $kpis = [
            ['label'=>'إجمالي الطلبات','value'=>'0','sub'=>'لا يوجد بعد','change'=>'جديد','color'=>'#6366F1','progress'=>'15%','shadow'=>'rgba(99,102,241,0.25)',
             'gradient'=>'from-[#6366F1] to-[#4F46E5]','badge'=>'bg-indigo-50 text-indigo-600',
             'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>'],
            ['label'=>'الإيرادات','value'=>'0 ج.م','sub'=>'لا يوجد بعد','change'=>'جديد','color'=>'#F59E0B','progress'=>'10%','shadow'=>'rgba(245,158,11,0.25)',
             'gradient'=>'from-[#FFC107] to-[#F59E0B]','badge'=>'bg-amber-50 text-amber-600',
             'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
            ['label'=>'المستخدمون','value'=>'0','sub'=>'لا يوجد بعد','change'=>'جديد','color'=>'#10B981','progress'=>'20%','shadow'=>'rgba(16,185,129,0.25)',
             'gradient'=>'from-[#10B981] to-[#059669]','badge'=>'bg-emerald-50 text-emerald-600',
             'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>'],
            ['label'=>'مناطق التوصيل','value'=>'0','sub'=>'لا يوجد بعد','change'=>'جديد','color'=>'#F97316','progress'=>'5%','shadow'=>'rgba(249,115,22,0.25)',
             'gradient'=>'from-[#F97316] to-[#EA580C]','badge'=>'bg-orange-50 text-orange-600',
             'icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>'],
        ];
    @endphp

    @foreach($kpis as $i => $kpi)
    <div class="kpi-card" style="animation-delay: {{ $i * 0.08 }}s;">
        <div class="card-shine"></div>
        {{-- Background circle --}}
        <div class="absolute -top-8 -left-8 w-32 h-32 rounded-full" style="background: {{ $kpi['color'] }}; opacity:0.05;"></div>

        <div class="flex items-start justify-between mb-5">
            <div class="metric-icon w-12 h-12 rounded-2xl flex items-center justify-center bg-gradient-to-br {{ $kpi['gradient'] }}" style="box-shadow: 0 8px 25px {{ $kpi['shadow'] }};">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $kpi['icon'] !!}
                </svg>
            </div>
            <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $kpi['badge'] }}">
                {{ $kpi['change'] }}
            </span>
        </div>

        <p class="text-gray-400 text-xs font-semibold mb-1">{{ $kpi['label'] }}</p>
        <p class="text-[#0B1536] font-black text-2xl tracking-tight">{{ $kpi['value'] }}</p>
        <p class="text-gray-300 text-xs mt-1.5">{{ $kpi['sub'] }}</p>

        {{-- Mini progress bar --}}
        <div class="mt-4 h-1.5 bg-gray-100 rounded-full overflow-hidden">
            <div class="progress-bar h-full rounded-full bg-gradient-to-r {{ $kpi['gradient'] }}"
                 style="--target-width: {{ $kpi['progress'] }}; animation-delay: {{ 0.4 + $i * 0.12 }}s;"></div>
        </div>
    </div>
    @endforeach

</div>

{{-- ====== MID ROW: Status + Quick Actions ====== --}}
<div class="grid grid-cols-1 lg:grid-cols-5 gap-5 mb-7">

    {{-- Profits Summary (Placeholder for logic) - 3 cols --}}
    <div class="lg:col-span-3 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-black text-[#0B1536] text-sm flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                ملخص الأرباح
            </h3>
            <span class="text-[10px] text-gray-400 font-bold bg-gray-50 px-2.5 py-1 rounded-full border border-gray-100">قريباً.. جاري العمل على برمجتها</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1">
            {{-- Daily Profits --}}
            <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl p-5 text-white relative overflow-hidden shadow-lg shadow-emerald-500/20 flex flex-col justify-center">
                <svg class="absolute -bottom-4 -left-4 w-24 h-24 text-white opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <p class="text-emerald-100 text-sm font-semibold mb-1 opacity-90">الأرباح اليومية</p>
                <h4 class="text-3xl font-black tracking-tight drop-shadow-md">0 <span class="text-lg font-bold text-emerald-200">ج.م</span></h4>
                <div class="mt-3 text-xs font-medium text-emerald-100 bg-black/10 self-start px-2 py-1 rounded-lg backdrop-blur-sm">
                    أرباح اليوم الحالي
                </div>
            </div>

            {{-- Monthly Profits --}}
            <div class="bg-gradient-to-br from-[#0B1536] to-[#1a2a5e] rounded-xl p-5 text-white relative overflow-hidden shadow-lg shadow-[#0B1536]/20 flex flex-col justify-center">
                <svg class="absolute -bottom-4 -left-4 w-24 h-24 text-white opacity-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p class="text-indigo-200 text-sm font-semibold mb-1 opacity-90">الأرباح الشهرية</p>
                <h4 class="text-3xl font-black tracking-tight drop-shadow-md">0 <span class="text-lg font-bold text-indigo-300">ج.م</span></h4>
                <div class="mt-3 text-xs font-medium text-indigo-200 bg-white/10 self-start px-2 py-1 rounded-lg backdrop-blur-sm">
                    أرباح الشهر الحالي
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions - 2 cols --}}
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col">
        <h3 class="font-black text-[#0B1536] text-sm mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-[#FFC107]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            إجراءات سريعة
        </h3>
        <div class="flex flex-col gap-2.5 flex-1">
            <a href="{{ route('admin.settings.edit') }}" class="group flex items-center gap-3 p-3.5 rounded-xl bg-gradient-to-r from-[#0B1536]/5 to-transparent hover:from-[#0B1536] hover:to-[#1a2a5e] transition-all duration-300 border border-transparent hover:border-[#0B1536]/20">
                <div class="w-9 h-9 rounded-xl bg-[#FFC107]/10 group-hover:bg-[#FFC107]/20 flex items-center justify-center transition-colors shrink-0">
                    <svg class="w-4 h-4 text-[#FFC107]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-[#0B1536] group-hover:text-white transition-colors">تحديث الإعدادات</p>
                    <p class="text-xs text-gray-400 group-hover:text-white/60 transition-colors truncate">أرقام الدفع وروابط التواصل</p>
                </div>
                <svg class="w-4 h-4 text-gray-200 group-hover:text-white/40 rotate-180 transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>

            <a href="{{ route('home') }}" target="_blank" class="group flex items-center gap-3 p-3.5 rounded-xl bg-gradient-to-r from-blue-50 to-transparent hover:from-blue-600 hover:to-blue-700 transition-all duration-300 border border-transparent hover:border-blue-500/20">
                <div class="w-9 h-9 rounded-xl bg-blue-100 group-hover:bg-blue-500/20 flex items-center justify-center transition-colors shrink-0">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-[#0B1536] group-hover:text-white transition-colors">معاينة الموقع</p>
                    <p class="text-xs text-gray-400 group-hover:text-white/60 transition-colors">فتح في تبويب جديد</p>
                </div>
                <svg class="w-4 h-4 text-gray-200 group-hover:text-white/40 rotate-180 transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>

            <a href="{{ route('contact') }}" target="_blank" class="group flex items-center gap-3 p-3.5 rounded-xl bg-gradient-to-r from-emerald-50 to-transparent hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 border border-transparent hover:border-emerald-500/20">
                <div class="w-9 h-9 rounded-xl bg-emerald-100 group-hover:bg-emerald-500/20 flex items-center justify-center transition-colors shrink-0">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-[#0B1536] group-hover:text-white transition-colors">صفحة التواصل</p>
                    <p class="text-xs text-gray-400 group-hover:text-white/60 transition-colors">عرض روابط التواصل الاجتماعي</p>
                </div>
                <svg class="w-4 h-4 text-gray-200 group-hover:text-white/40 rotate-180 transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</div>

{{-- ====== SETTINGS PREVIEW TABLE ====== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
        <h3 class="font-black text-[#0B1536] text-sm flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-[#FFC107]/10 flex items-center justify-center">
                <svg class="w-3.5 h-3.5 text-[#FFC107]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            إعدادات النظام الحالية
            <span class="text-[10px] font-bold bg-gray-100 text-gray-400 px-2 py-0.5 rounded-full">{{ count($settings) }} عنصر</span>
        </h3>
        <a href="{{ route('admin.settings.edit') }}" class="group flex items-center gap-1.5 text-xs font-bold text-[#FFC107] hover:text-yellow-600 transition-colors">
            <svg class="w-3.5 h-3.5 group-hover:rotate-45 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
            </svg>
            تعديل الكل
        </a>
    </div>
    <div class="divide-y divide-gray-50/80">
        @foreach($settings as $key => $value)
        @php
            $icons = [
                'vodafone_cash_number' => ['bg'=>'bg-red-50','text'=>'text-red-500','label'=>'فودافون كاش'],
                'etisalat_cash_number' => ['bg'=>'bg-green-50','text'=>'text-green-500','label'=>'اتصالات كاش'],
                'whatsapp_link'        => ['bg'=>'bg-emerald-50','text'=>'text-emerald-500','label'=>'واتساب'],
                'facebook_link'        => ['bg'=>'bg-blue-50','text'=>'text-blue-500','label'=>'فيسبوك'],
                'instagram_link'       => ['bg'=>'bg-pink-50','text'=>'text-pink-500','label'=>'انستجرام'],
                'youtube_link'         => ['bg'=>'bg-red-50','text'=>'text-red-500','label'=>'يوتيوب'],
                'tiktok_link'          => ['bg'=>'bg-gray-100','text'=>'text-gray-600','label'=>'تيك توك'],
            ];
            $info = $icons[$key] ?? ['bg'=>'bg-gray-50','text'=>'text-gray-400','label'=>$key];
        @endphp
        <div class="group flex items-center justify-between px-6 py-3.5 hover:bg-gray-50/60 transition-colors">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl {{ $info['bg'] }} flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-200">
                    <svg class="w-3.5 h-3.5 {{ $info['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-black text-[#0B1536]">{{ $info['label'] }}</p>
                    <p class="text-[10px] text-gray-300 font-mono">{{ $key }}</p>
                </div>
            </div>
            <div class="flex items-center justify-end gap-2 w-[60%]">
                {{-- Value Pill --}}
                <div class="flex-1 bg-gray-50/80 border border-gray-100 rounded-lg px-3 py-2 flex items-center justify-end transition-colors group-hover:bg-white group-hover:border-gray-200 shadow-sm">
                    <span class="text-[11px] font-semibold text-gray-500 font-mono truncate text-left w-full" dir="ltr">{{ empty($value) ? '---' : $value }}</span>
                </div>
                
                {{-- Action Button --}}
                @if(str_starts_with($value, 'http'))
                <a href="{{ $value }}" target="_blank" class="shrink-0 w-8 h-8 rounded-lg bg-white border border-gray-100 shadow-sm hover:bg-[#FFC107] hover:border-[#FFC107] hover:text-white text-gray-400 flex items-center justify-center transition-all duration-300">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
                @else
                {{-- Placeholder to keep perfect alignment for items without link --}}
                <div class="shrink-0 w-8 h-8"></div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
