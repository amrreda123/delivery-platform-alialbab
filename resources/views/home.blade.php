@extends('layouts.app')

@section('content')

<!-- Hero Section - Full Width, Edge to Edge -->
<section class="w-full overflow-hidden mb-8">
    <!-- flex-row in RTL: first=RIGHT, second=LEFT -->
    <div class="flex flex-row min-h-[420px] lg:min-h-[500px]">

        <!-- RIGHT: Text Area with delivery.jpg background (first in HTML = RIGHT in RTL) -->
        <div class="w-full lg:w-[60%] relative flex flex-col justify-center px-10 lg:px-16 xl:px-20 py-14">
            <!-- delivery.jpg as background -->
            <img src="{{ asset('images/delivery.jpg') }}"
                 alt=""
                 class="absolute inset-0 w-full h-full object-cover object-left"
                 aria-hidden="true">
            <!-- White overlay for readability -->
            <div class="absolute inset-0 bg-white/45"></div>

            <!-- Text Content -->
            <div class="relative z-10" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-4xl lg:text-5xl xl:text-[64px] font-black leading-[1.1] mb-4 text-[#0B1536]">
                    علي الباب<br>
                    نوصل اللي يهمك<br>
                    <span class="text-[#FFC107]">لباب بيتك</span>
                </h1>
                <p class="text-gray-500 text-base lg:text-lg mb-10 max-w-sm leading-relaxed">
                    توصيل سريع وآمن من المطاعم، الصيدليات، السوبر ماركت، المتاجر وأي غرض تريده
                </p>
                <div class="flex flex-wrap gap-4">
                    <button class="bg-[#FFC107] text-[#0B1536] px-10 py-3 rounded-xl font-bold shadow-md hover:bg-yellow-500 transition flex items-center justify-center gap-2 text-base min-w-[160px]">
                        اطلب الآن
                        <svg class="w-5 h-5 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="px-7 py-3 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition flex items-center gap-2 bg-white shadow-sm text-base">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        تتبع طلبك
                    </button>
                </div>
            </div>
        </div>

        <!-- LEFT: Delivery Man Image (second in HTML = LEFT in RTL) -->
        <div class="w-[40%] relative hidden lg:block" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="300">
            <img src="{{ asset('images/hero.png') }}"
                 alt="مندوب التوصيل علي الباب"
                 class="absolute inset-0 w-full h-full object-cover object-center">
        </div>

    </div>
</section>

<!-- Services Grid -->
<section class="py-20 px-6 md:px-12" style="background: linear-gradient(180deg, #ffffff 0%, #f8f9ff 100%);">
    <div class="max-w-7xl mx-auto">

        {{-- Section Header --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block text-xs font-bold tracking-[0.2em] text-[#FFC107] uppercase mb-3">ماذا نقدم</span>
            <h2 class="text-4xl lg:text-5xl font-black text-[#0B1536] mb-4">خدماتنا</h2>
            <div class="flex items-center justify-center gap-2 mt-4">
                <div class="h-1 w-16 rounded-full bg-[#FFC107]"></div>
                <div class="h-1 w-4 rounded-full bg-[#FFC107]/40"></div>
            </div>
            <p class="text-gray-500 mt-5 text-base max-w-lg mx-auto leading-relaxed">
                نوفر لك خدمات توصيل متكاملة تغطي كل احتياجاتك اليومية بسرعة وأمان
            </p>
        </div>

        {{-- Services Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-5">

            {{-- Service: Clothes --}}
            <div data-aos="fade-up" data-aos-delay="100" class="service-card group relative bg-white rounded-[24px] p-6 flex flex-col items-center text-center cursor-pointer border border-gray-100/80 hover:-translate-y-2 hover:shadow-2xl hover:shadow-purple-100/60 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-[24px]" style="background: linear-gradient(135deg, #f5f2f9 0%, #ede9f6 100%);"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-20 h-20 mb-5 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                        <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.57a1 1 0 00.99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.57a2 2 0 00-1.34-2.23z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-[#0B1536] mb-1.5 leading-tight">توصيل ملابس</h3>
                    <p class="text-xs text-gray-400 font-medium mb-4 leading-relaxed">من جميع المتاجر</p>
                    <div class="w-10 h-1 rounded-full transition-all duration-300 group-hover:w-16" style="background: linear-gradient(90deg, #8B5CF6, #7C3AED);"></div>
                </div>
            </div>

            {{-- Service: Restaurants --}}
            <div data-aos="fade-up" data-aos-delay="200" class="service-card group relative bg-white rounded-[24px] p-6 flex flex-col items-center text-center cursor-pointer border border-gray-100/80 hover:-translate-y-2 hover:shadow-2xl hover:shadow-orange-100/60 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-[24px]" style="background: linear-gradient(135deg, #fff7f0 0%, #fff0e6 100%);"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-20 h-20 mb-5 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md" style="background: linear-gradient(135deg, #F97316 0%, #EA580C 100%);">
                        <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-[#0B1536] mb-1.5 leading-tight">توصيل مطاعم</h3>
                    <p class="text-xs text-gray-400 font-medium mb-4 leading-relaxed">أطيب الأكل، لباب بيتك</p>
                    <div class="w-10 h-1 rounded-full transition-all duration-300 group-hover:w-16" style="background: linear-gradient(90deg, #F97316, #EA580C);"></div>
                </div>
            </div>

            {{-- Service: Pharmacies --}}
            <div data-aos="fade-up" data-aos-delay="300" class="service-card group relative bg-white rounded-[24px] p-6 flex flex-col items-center text-center cursor-pointer border border-gray-100/80 hover:-translate-y-2 hover:shadow-2xl hover:shadow-teal-100/60 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-[24px]" style="background: linear-gradient(135deg, #f0fdfb 0%, #e6f9f7 100%);"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-20 h-20 mb-5 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md" style="background: linear-gradient(135deg, #14B8A6 0%, #0D9488 100%);">
                        <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="4"/><path d="M12 8v8M8 12h8"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-[#0B1536] mb-1.5 leading-tight">توصيل صيدليات</h3>
                    <p class="text-xs text-gray-400 font-medium mb-4 leading-relaxed">دواؤك يوصلك بسرعة</p>
                    <div class="w-10 h-1 rounded-full transition-all duration-300 group-hover:w-16" style="background: linear-gradient(90deg, #14B8A6, #0D9488);"></div>
                </div>
            </div>

            {{-- Service: Supermarket --}}
            <div data-aos="fade-up" data-aos-delay="400" class="service-card group relative bg-white rounded-[24px] p-6 flex flex-col items-center text-center cursor-pointer border border-gray-100/80 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-100/60 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-[24px]" style="background: linear-gradient(135deg, #eff6ff 0%, #e8f0fe 100%);"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-20 h-20 mb-5 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md" style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);">
                        <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 001.94-1.5l1.32-6.5H6"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-[#0B1536] mb-1.5 leading-tight">توصيل سوبر ماركت</h3>
                    <p class="text-xs text-gray-400 font-medium mb-4 leading-relaxed">كل احتياجاتك اليومية</p>
                    <div class="w-10 h-1 rounded-full transition-all duration-300 group-hover:w-16" style="background: linear-gradient(90deg, #3B82F6, #2563EB);"></div>
                </div>
            </div>

            {{-- Service: Any Item --}}
            <div data-aos="fade-up" data-aos-delay="500" class="service-card group relative bg-white rounded-[24px] p-6 flex flex-col items-center text-center cursor-pointer border border-gray-100/80 hover:-translate-y-2 hover:shadow-2xl hover:shadow-yellow-100/60 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-[24px]" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-20 h-20 mb-5 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md" style="background: linear-gradient(135deg, #FFC107 0%, #F59E0B 100%);">
                        <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-[#0B1536] mb-1.5 leading-tight">توصيل أي غرض</h3>
                    <p class="text-xs text-gray-400 font-medium mb-4 leading-relaxed">نوصل أي شيء تريده</p>
                    <div class="w-10 h-1 rounded-full transition-all duration-300 group-hover:w-16" style="background: linear-gradient(90deg, #FFC107, #F59E0B);"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Features Bottom Row -->
<section class="max-w-7xl mx-auto px-6 md:px-12 py-8 mb-20" data-aos="fade-up">
    <div class="bg-[#F8F9FB] rounded-[30px] p-6 lg:p-10 flex flex-wrap lg:flex-nowrap items-center justify-between gap-8 border border-gray-100">
        
        <!-- Feature 4: Live Tracking -->
        <div class="flex items-center gap-5 flex-1 justify-center lg:justify-start lg:border-l border-gray-200 last:border-0 pl-6" data-aos="fade-up" data-aos-delay="100">
            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-lg text-[#0B1536]">تتبع مباشر للطلب</h4>
                <p class="text-sm text-gray-500 mt-1">تابع طلبك لحظة بلحظة</p>
            </div>
        </div>

        <!-- Feature 3: 24/7 Support -->
        <div class="flex items-center gap-5 flex-1 justify-center lg:justify-start lg:border-l border-gray-200 last:border-0 pl-6" data-aos="fade-up" data-aos-delay="200">
            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-lg text-[#0B1536]">دعم على مدار الساعة</h4>
                <p class="text-sm text-gray-500 mt-1">نحن هنا لخدمتك</p>
            </div>
        </div>
        
        <!-- Feature 2: Secure & Trusted -->
        <div class="flex items-center gap-5 flex-1 justify-center lg:justify-start lg:border-l border-gray-200 last:border-0 pl-6" data-aos="fade-up" data-aos-delay="300">
            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-lg text-[#0B1536]">آمن وموثوق</h4>
                <p class="text-sm text-gray-500 mt-1">طلبك في أيدٍ أمينة</p>
            </div>
        </div>

        <!-- Feature 1: Fast Delivery -->
        <div class="flex items-center gap-5 flex-1 justify-center lg:justify-start last:border-0" data-aos="fade-up" data-aos-delay="400">
            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-lg text-[#0B1536]">توصيل سريع</h4>
                <p class="text-sm text-gray-500 mt-1">في أسرع وقت</p>
            </div>
        </div>
        
    </div>
</section>

@endsection