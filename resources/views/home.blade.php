@extends('layouts.app')

@section('content')

<!-- Hero Section - Full Width, Edge to Edge -->
<section class="w-full overflow-hidden mb-8">
    <!-- flex-row in RTL: first=RIGHT, second=LEFT -->
    <div class="flex flex-row min-h-[75vh] lg:min-h-[80vh]">

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
                    <a href="{{ route('profile') }}" class="px-7 py-3 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition flex items-center gap-2 bg-white shadow-sm text-base">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        تتبع طلبك
                    </a>
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

            @foreach($categories as $index => $category)
                <x-service-card :category="$category" :index="$index" />
            @endforeach

        </div>
    </div>
</section>

<!-- Features Bottom Row -->
<section class="max-w-7xl mx-auto px-6 md:px-12 py-8 mb-20" data-aos="fade-up">
    <div class="bg-white rounded-[30px] p-6 lg:p-10 flex flex-col md:flex-row flex-wrap lg:flex-nowrap items-start md:items-center justify-between gap-8 md:gap-4 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100">
        
        <!-- Feature 4: Live Tracking -->
        <div class="flex items-center gap-4 flex-1 justify-start lg:border-l border-gray-100 last:border-0 lg:pl-6" data-aos="fade-up" data-aos-delay="100">
            <div class="w-14 h-14 bg-[#F8F9FB] rounded-2xl flex items-center justify-center shrink-0 group hover:bg-[#FFC107]/10 transition-colors duration-300">
                <svg class="w-6 h-6 text-[#0B1536] group-hover:text-[#FFC107] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <div class="text-right">
                <h4 class="font-bold text-[17px] text-[#0B1536] mb-1">تتبع مباشر للطلب</h4>
                <p class="text-sm text-gray-500 font-medium">تابع طلبك لحظة بلحظة</p>
            </div>
        </div>

        <!-- Feature 3: 24/7 Support -->
        <div class="flex items-center gap-4 flex-1 justify-start lg:border-l border-gray-100 last:border-0 lg:pl-6" data-aos="fade-up" data-aos-delay="200">
            <div class="w-14 h-14 bg-[#F8F9FB] rounded-2xl flex items-center justify-center shrink-0 group hover:bg-[#FFC107]/10 transition-colors duration-300">
                <svg class="w-6 h-6 text-[#0B1536] group-hover:text-[#FFC107] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div class="text-right">
                <h4 class="font-bold text-[17px] text-[#0B1536] mb-1">دعم على مدار الساعة</h4>
                <p class="text-sm text-gray-500 font-medium">نحن هنا لخدمتك دائماً</p>
            </div>
        </div>
        
        <!-- Feature 2: Secure & Trusted -->
        <div class="flex items-center gap-4 flex-1 justify-start lg:border-l border-gray-100 last:border-0 lg:pl-6" data-aos="fade-up" data-aos-delay="300">
            <div class="w-14 h-14 bg-[#F8F9FB] rounded-2xl flex items-center justify-center shrink-0 group hover:bg-[#FFC107]/10 transition-colors duration-300">
                <svg class="w-6 h-6 text-[#0B1536] group-hover:text-[#FFC107] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <div class="text-right">
                <h4 class="font-bold text-[17px] text-[#0B1536] mb-1">آمن وموثوق</h4>
                <p class="text-sm text-gray-500 font-medium">طلبك في أيدٍ أمينة</p>
            </div>
        </div>

        <!-- Feature 1: Fast Delivery -->
        <div class="flex items-center gap-4 flex-1 justify-start last:border-0" data-aos="fade-up" data-aos-delay="400">
            <div class="w-14 h-14 bg-[#F8F9FB] rounded-2xl flex items-center justify-center shrink-0 group hover:bg-[#FFC107]/10 transition-colors duration-300">
                <svg class="w-6 h-6 text-[#0B1536] group-hover:text-[#FFC107] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div class="text-right">
                <h4 class="font-bold text-[17px] text-[#0B1536] mb-1">توصيل سريع</h4>
                <p class="text-sm text-gray-500 font-medium">نوصلك في أسرع وقت</p>
            </div>
        </div>
        
    </div>
</section>

<!-- Contact & Payment Section -->
<section class="max-w-7xl mx-auto px-6 md:px-12 py-12 mb-20">
    <div class="text-center mb-16" data-aos="fade-up">
        <span class="inline-block text-xs font-bold tracking-[0.2em] text-[#FFC107] uppercase mb-3">تواصل وادفع بسهولة</span>
        <h2 class="text-3xl lg:text-4xl font-black text-[#0B1536] mb-4">طرق الدفع والتواصل</h2>
        <div class="flex items-center justify-center gap-2 mt-4">
            <div class="h-1 w-16 rounded-full bg-[#FFC107]"></div>
            <div class="h-1 w-4 rounded-full bg-[#FFC107]/40"></div>
        </div>
        <p class="text-gray-500 mt-5 text-base max-w-lg mx-auto leading-relaxed">
            نوفر لك خيارات دفع إلكترونية مريحة وآمنة، ونسعد بتواصلك معنا دائماً
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
        
        <!-- Vodafone Cash -->
        <div data-aos="fade-up" data-aos-delay="100" class="group relative bg-white rounded-3xl p-8 flex flex-col items-center justify-center text-center border border-red-100 hover:shadow-2xl hover:shadow-red-200/50 transition-all duration-300 overflow-hidden min-h-[280px]">
            <div class="absolute inset-0 bg-gradient-to-br from-red-50 to-red-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <!-- Floating Elements -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-red-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            
            <div class="relative z-10 flex flex-col items-center w-full">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#E60000] to-[#b30000] flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-xl shadow-red-500/30">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-bold text-2xl text-gray-900 mb-4">فودافون كاش</h3>
                
                <!-- Number Box -->
                <div class="bg-white/80 backdrop-blur-sm px-6 py-4 rounded-xl shadow-sm border border-red-100 w-full mb-3 flex items-center justify-between group-hover:border-red-300 transition-colors relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <span class="font-black text-2xl lg:text-3xl text-[#E60000] tracking-[0.1em] relative z-10 font-mono" dir="ltr">{{ !empty($settings['vodafone_cash_number']) ? $settings['vodafone_cash_number'] : '01060401725' }}</span>
                    <button onclick="navigator.clipboard.writeText('{{ !empty($settings['vodafone_cash_number']) ? $settings['vodafone_cash_number'] : '01060401725' }}')" class="text-red-300 hover:text-[#E60000] hover:bg-red-50 p-2 rounded-lg transition-all relative z-10" title="نسخ الرقم">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    </button>
                </div>
                <p class="text-sm text-gray-500 font-medium">للتحويلات والدفع السريع</p>
            </div>
        </div>

        <!-- Etisalat Cash -->
        <div data-aos="fade-up" data-aos-delay="200" class="group relative bg-white rounded-3xl p-8 flex flex-col items-center justify-center text-center border border-green-100 hover:shadow-2xl hover:shadow-green-200/50 transition-all duration-300 overflow-hidden min-h-[280px]">
            <div class="absolute inset-0 bg-gradient-to-br from-[#73C044]/10 to-[#73C044]/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <!-- Floating Elements -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#73C044]/10 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

            <div class="relative z-10 flex flex-col items-center w-full">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#73C044] to-[#5a9a34] flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-xl shadow-[#73C044]/30">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-bold text-2xl text-gray-900 mb-4">اتصالات كاش</h3>
                
                <!-- Number Box -->
                <div class="bg-white/80 backdrop-blur-sm px-6 py-4 rounded-xl shadow-sm border border-green-100 w-full mb-3 flex items-center justify-between group-hover:border-[#73C044]/40 transition-colors relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#73C044]/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <span class="font-black text-2xl lg:text-3xl text-[#73C044] tracking-[0.1em] relative z-10 font-mono" dir="ltr">{{ !empty($settings['etisalat_cash_number']) ? $settings['etisalat_cash_number'] : '01130424003' }}</span>
                    <button onclick="navigator.clipboard.writeText('{{ !empty($settings['etisalat_cash_number']) ? $settings['etisalat_cash_number'] : '01130424003' }}')" class="text-green-300 hover:text-[#73C044] hover:bg-[#73C044]/10 p-2 rounded-lg transition-all relative z-10" title="نسخ الرقم">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    </button>
                </div>
                <p class="text-sm text-gray-500 font-medium">أسهل طريقة للدفع المباشر</p>
            </div>
        </div>

    </div>
</section>

@endsection