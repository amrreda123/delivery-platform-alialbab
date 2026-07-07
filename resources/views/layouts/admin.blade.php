<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم') - علي الباب</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { font-family: 'Tajawal', sans-serif; }

        /* ========== SIDEBAR ANIMATIONS ========== */
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }
        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.4); }
            50%       { box-shadow: 0 0 0 8px rgba(255, 193, 7, 0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-6px); }
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        @keyframes blob {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            25%       { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
            50%       { border-radius: 50% 60% 30% 60% / 30% 50% 70% 50%; }
            75%       { border-radius: 60% 30% 60% 40% / 60% 70% 30% 50%; }
        }

        /* ========== SIDEBAR ========== */
        .admin-sidebar {
            background: linear-gradient(160deg, #0B1536 0%, #111f4d 40%, #0d1a40 70%, #0B1536 100%);
            animation: slideInRight 0.5s ease-out;
            position: relative;
            overflow: hidden;
        }
        .admin-sidebar::before {
            content: '';
            position: absolute;
            top: -80px; left: -80px;
            width: 220px; height: 220px;
            background: radial-gradient(circle, rgba(255,193,7,0.08) 0%, transparent 70%);
            animation: blob 12s ease-in-out infinite;
            pointer-events: none;
        }
        .admin-sidebar::after {
            content: '';
            position: absolute;
            bottom: -60px; right: -60px;
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(99,102,241,0.08) 0%, transparent 70%);
            animation: blob 15s ease-in-out infinite reverse;
            pointer-events: none;
        }

        /* ========== SIDEBAR NAV LINKS ========== */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255,255,255,0.6);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .sidebar-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(255,193,7,0.12) 0%, rgba(255,193,7,0.04) 100%);
            border-radius: 14px;
            opacity: 0;
            transition: opacity 0.25s;
        }
        .sidebar-link:hover { color: #fff; transform: translateX(-4px); }
        .sidebar-link:hover::before { opacity: 1; }
        .sidebar-link.active {
            color: #fff;
            background: linear-gradient(90deg, rgba(255,193,7,0.2) 0%, rgba(255,193,7,0.08) 100%);
            border: 1px solid rgba(255,193,7,0.2);
            box-shadow: 0 4px 20px rgba(255,193,7,0.1);
        }
        .sidebar-link.active svg { color: #FFC107; }
        .sidebar-link.active::after {
            content: '';
            position: absolute;
            right: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 60%;
            background: #FFC107;
            border-radius: 0 3px 3px 0;
        }

        /* ========== LOGO ========== */
        .logo-icon {
            animation: pulse-glow 3s ease-in-out infinite, float 4s ease-in-out infinite;
        }

        /* ========== MAIN CONTENT ========== */
        .main-content { background: #F0F4FD; }

        /* ========== TOP BAR ========== */
        .top-bar {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }

        /* ========== KPI CARDS ========== */
        .kpi-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.05);
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeInUp 0.6s ease-out both;
        }
        .kpi-card:hover { transform: translateY(-5px); box-shadow: 0 20px 50px rgba(0,0,0,0.1); }
        .kpi-card::before {
            content: '';
            position: absolute;
            top: -40px; left: -40px;
            width: 120px; height: 120px;
            border-radius: 50%;
            opacity: 0.07;
            transition: all 0.5s;
        }
        .kpi-card:hover::before { transform: scale(2.5); opacity: 0.05; }

        /* ========== GLASS CARD ========== */
        .glass-card {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }

        /* ========== SHIMMER BADGE ========== */
        .shimmer-badge {
            background: linear-gradient(90deg, #FFC107 0%, #FFD95A 50%, #FFC107 100%);
            background-size: 200% auto;
            animation: shimmer 3s linear infinite;
        }

        /* ========== STATUS DOT ========== */
        .status-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #10B981;
            animation: pulse-glow 2s ease-in-out infinite;
            box-shadow: 0 0 0 0 rgba(16,185,129,0.4);
        }

        /* ========== STAGGERED ANIMATION ========== */
        .kpi-card:nth-child(1) { animation-delay: 0.05s; }
        .kpi-card:nth-child(2) { animation-delay: 0.12s; }
        .kpi-card:nth-child(3) { animation-delay: 0.19s; }
        .kpi-card:nth-child(4) { animation-delay: 0.26s; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.12); border-radius: 99px; }
    </style>
</head>
<body class="main-content antialiased overflow-hidden h-screen">

<div class="flex h-screen" dir="rtl">

    {{-- ====== SIDEBAR ====== --}}
    <aside class="admin-sidebar w-64 shrink-0 flex flex-col h-full z-30 shadow-2xl relative">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3.5 px-6 py-5 border-b border-white/10 hover:bg-white/5 transition-all duration-300 group relative z-10">
            <div class="logo-icon w-11 h-11 bg-[#FFC107] rounded-2xl flex items-center justify-center shadow-2xl shrink-0">
                <svg class="w-5 h-5 text-[#0B1536]" viewBox="0 0 24 24" fill="none">
                    <path d="M12 3H18C18.5523 3 19 3.44772 19 4V21H12V3Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 3L6 5V19L12 21V3Z" fill="currentColor"/>
                    <circle cx="10" cy="12" r="1" fill="white"/>
                </svg>
            </div>
            <div>
                <span class="text-white font-black text-[17px] leading-none block tracking-tight">علي الباب</span>
                <span class="text-[#FFC107] text-xs font-semibold opacity-90">لوحة التحكم</span>
            </div>
            <svg class="w-4 h-4 text-white/20 group-hover:text-white/50 transition-colors mr-auto rotate-180 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-5 space-y-0.5 overflow-y-auto relative z-10 scrollbar-hide">
            <p class="text-white/25 text-[10px] font-black uppercase tracking-[0.2em] px-4 mb-3 mt-1">القائمة الرئيسية</p>

            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 13a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1h-4a1 1 0 01-1-1v-6z"/>
                </svg>
                لوحة التحكم
            </a>

            <a href="{{ route('admin.settings.edit') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                إعدادات النظام
            </a>

            <div class="pt-4 mt-3 border-t border-white/10">
                <p class="text-white/25 text-[10px] font-black uppercase tracking-[0.2em] px-4 mb-3">الموقع</p>
                <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                    معاينة الموقع
                </a>
                <a href="{{ route('contact') }}" target="_blank" class="sidebar-link">
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    تواصل معنا
                </a>
            </div>
        </nav>

        {{-- Footer --}}
        <div class="px-5 py-4 border-t border-white/10 relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#FFC107] to-[#F59E0B] flex items-center justify-center text-[#0B1536] font-black text-xs shadow-lg">م</div>
                <div>
                    <p class="text-white/80 text-xs font-bold leading-none">المدير العام</p>
                    <p class="text-white/30 text-[10px] mt-0.5">علي الباب © {{ date('Y') }}</p>
                </div>
                <div class="status-dot mr-auto"></div>
            </div>
        </div>
    </aside>

    {{-- ====== MAIN CONTENT ====== --}}
    <div class="flex-1 flex flex-col h-screen overflow-hidden">

        {{-- Top Bar --}}
        <header class="top-bar sticky top-0 z-20 px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                {{-- Breadcrumb --}}
                <div>
                    <h1 class="text-[18px] font-black text-[#0B1536] leading-none">@yield('page-title', 'لوحة التحكم')</h1>
                    <p class="text-gray-400 text-xs mt-1">@yield('page-subtitle', 'مرحباً بك في لوحة إدارة علي الباب')</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                {{-- Date --}}
                <div class="hidden md:flex items-center gap-2 bg-gray-100 rounded-xl px-4 py-2">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-xs font-semibold text-gray-500">{{ now()->format('d M Y') }}</span>
                </div>
                {{-- Notification bell --}}
                <button class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors relative">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                </button>
                {{-- Avatar --}}
                <div class="w-9 h-9 bg-gradient-to-br from-[#FFC107] to-[#F59E0B] rounded-xl flex items-center justify-center text-[#0B1536] font-black text-sm shadow-lg cursor-pointer hover:shadow-xl transition-shadow">م</div>
            </div>
        </header>

        {{-- Success Alert --}}
        @if(session('success'))
        <div class="mx-8 mt-5 bg-emerald-50 border border-emerald-200/70 text-emerald-800 px-5 py-3.5 rounded-2xl flex items-center gap-3 shadow-sm animate-[fadeInUp_0.4s_ease-out]" id="success-alert">
            <div class="w-7 h-7 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <span class="font-semibold text-sm flex-1">{{ session('success') }}</span>
            <button onclick="document.getElementById('success-alert').remove()" class="text-emerald-300 hover:text-emerald-600 transition p-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>
    </div>

</div>

</body>
</html>
