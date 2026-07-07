@extends('layouts.app')

@section('content')

<!-- Custom Animations for Action -->
<style>
    @keyframes float {
        0%, 100% { transform: translateY(-50%) translateX(50%); }
        50% { transform: translateY(-60%) translateX(40%); }
    }
    @keyframes float-reverse {
        0%, 100% { transform: translateY(50%) translateX(-50%); }
        50% { transform: translateY(60%) translateX(-40%); }
    }
    @keyframes bounce-x {
        0%, 100% { transform: translateX(0) rotate(180deg); }
        50% { transform: translateX(-5px) rotate(180deg); }
    }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-float-reverse { animation: float-reverse 7s ease-in-out infinite; }
    .group:hover .animate-bounce-x { animation: bounce-x 1s infinite; }
    
    .hover-lift { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .hover-lift:hover { transform: translateY(-10px) scale(1.02); z-index: 10; }
    
    .glow-on-hover:hover { box-shadow: 0 0 25px rgba(255, 193, 7, 0.5); }
</style>

<!-- Hero Banner for Services -->
<div class="relative pt-32 pb-24 overflow-hidden border-b border-gray-100 flex items-center justify-center min-h-[450px]">
    <!-- Animated Background Image -->
    <div class="absolute inset-0 w-full h-full z-0 overflow-hidden">
        <img src="{{ asset('images/delivery.jpg') }}" alt="Delivery Background" class="absolute inset-0 w-full h-full object-cover object-center animate-ken-burns" style="animation: ken-burns 20s ease-in-out infinite alternate;">
        <!-- Overlays for readability -->
        <div class="absolute inset-0 bg-white/60 backdrop-blur-[3px]"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/30 to-[#FAFAFA]"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 md:px-12 text-center z-10" data-aos="fade-down" data-aos-duration="1000">
        <span class="inline-block px-5 py-2 rounded-full bg-white text-[#B45309] font-bold text-sm mb-6 border border-yellow-200 shadow-sm hover:scale-110 transition-all duration-300 cursor-default">
            🚀 أسرع توصيل في مدينتك
        </span>
        <h1 class="text-4xl md:text-6xl font-black text-[#0B1536] mb-6 leading-tight hover:scale-105 transition-transform duration-500">
            عشان وقتك غالي،<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FFC107] to-[#F59E0B]">بنوصلك في نفس اليوم</span>
        </h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-10 leading-relaxed">
            انسَ الانتظار 3 أو 4 أيام! مع <span class="text-[#0B1536] font-black border-b-2 border-[#FFC107]">علي الباب</span>، طلباتك بتوصلك في أسرع وقت. نغطي كل احتياجاتك اليومية بموثوقية وسرعة خيالية.
        </p>
    </div>
</div>

<!-- Features / Benefits Section -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-black text-[#0B1536] mb-4">ليه تختار "علي الباب"؟</h2>
            <div class="h-1 w-20 bg-[#FFC107] mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div data-aos="fade-up" data-aos-delay="100" class="bg-[#F8F9FB] rounded-3xl p-8 border border-gray-100 hover-lift hover:shadow-2xl hover:shadow-blue-500/10 group cursor-default">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-md group-hover:scale-110 group-hover:rotate-6 transition-all duration-300" style="color: #3B82F6;">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-[#0B1536] mb-3 group-hover:text-blue-600 transition-colors">سرعة البرق</h3>
                <p class="text-gray-500 leading-relaxed">توصيل في نفس اليوم لجميع الطلبات. مفيش داعي تستنى أيام عشان تستلم اللي محتاجه، إحنا دايماً جنبك.</p>
            </div>
            
            <!-- Feature 2 -->
            <div data-aos="fade-up" data-aos-delay="200" class="bg-[#F8F9FB] rounded-3xl p-8 border border-gray-100 hover-lift hover:shadow-2xl hover:shadow-emerald-500/10 group cursor-default">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-md group-hover:scale-110 group-hover:-rotate-6 transition-all duration-300" style="color: #10B981;">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-[#0B1536] mb-3 group-hover:text-emerald-600 transition-colors">أمان وثقة</h3>
                <p class="text-gray-500 leading-relaxed">مندوبينا مدربين على أعلى مستوى لضمان وصول طلباتك بأمان تام وحالة ممتازة، كأنك استلمتها بنفسك.</p>
            </div>

            <!-- Feature 3 -->
            <div data-aos="fade-up" data-aos-delay="300" class="bg-[#F8F9FB] rounded-3xl p-8 border border-gray-100 hover-lift hover:shadow-2xl hover:shadow-purple-500/10 group cursor-default">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-md group-hover:scale-110 group-hover:rotate-6 transition-all duration-300" style="color: #8B5CF6;">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-[#0B1536] mb-3 group-hover:text-purple-600 transition-colors">تنوع بلا حدود</h3>
                <p class="text-gray-500 leading-relaxed">مش بس أكل أو سوبر ماركت، بنوصل لك أي غرض من أي مكان. إنت بس اطلب والباقي علينا.</p>
            </div>
        </div>
    </div>
</section>

<!-- Ongoing Offers -->
<section class="py-20 overflow-hidden" style="background: linear-gradient(180deg, #f8f9ff 0%, #ffffff 100%);">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-6" data-aos="fade-up">
            <div>
                <h2 class="text-3xl md:text-4xl font-black text-[#0B1536] mb-4">عروضنا المستمرة</h2>
                <div class="h-1 w-16 bg-[#FFC107] rounded-full"></div>
            </div>
            <button class="px-8 py-3 bg-[#0B1536] text-white rounded-xl font-bold hover:bg-gray-800 hover:-translate-y-1 transition-all shadow-lg glow-on-hover">
                تصفح كل العروض
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Offer 1 -->
            <div data-aos="fade-up" data-aos-delay="100" class="relative bg-white rounded-[32px] p-8 md:p-10 border border-gray-100 shadow-xl overflow-hidden flex flex-col md:flex-row items-center gap-8 hover-lift cursor-pointer group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-500 rounded-full mix-blend-multiply filter blur-[64px] opacity-20 group-hover:scale-150 group-hover:opacity-30 transition-all duration-700"></div>
                <div class="relative z-10 flex-1">
                    <span class="inline-block px-3 py-1 bg-red-100 text-red-600 rounded-lg text-sm font-bold mb-4 animate-pulse">🔥 عرض جديد</span>
                    <h3 class="text-2xl font-bold text-[#0B1536] mb-3 group-hover:text-red-600 transition-colors">توصيل مجاني لطلبك الأول!</h3>
                    <p class="text-gray-500 mb-6 leading-relaxed">استخدم كود <span class="font-bold text-[#0B1536] bg-gray-100 px-2 py-1 rounded border border-gray-200">WELCOME</span> واحصل على توصيل مجاني بالكامل لأول أوردر ليك من أي مكان.</p>
                </div>
                <div class="relative z-10 w-32 h-32 shrink-0 bg-red-50 rounded-2xl flex items-center justify-center border border-red-100 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500 shadow-inner">
                    <span class="text-5xl drop-shadow-md">🎁</span>
                </div>
            </div>

            <!-- Offer 2 -->
            <div data-aos="fade-up" data-aos-delay="200" class="relative bg-white rounded-[32px] p-8 md:p-10 border border-gray-100 shadow-xl overflow-hidden flex flex-col md:flex-row items-center gap-8 hover-lift cursor-pointer group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#FFC107] rounded-full mix-blend-multiply filter blur-[64px] opacity-20 group-hover:scale-150 group-hover:opacity-30 transition-all duration-700"></div>
                <div class="relative z-10 flex-1">
                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-sm font-bold mb-4 animate-pulse">⭐ عروض المطاعم</span>
                    <h3 class="text-2xl font-bold text-[#0B1536] mb-3 group-hover:text-yellow-600 transition-colors">خصم 20% على وجبة الغداء</h3>
                    <p class="text-gray-500 mb-6 leading-relaxed">اطلب من مطاعمك المفضلة بين الساعة 2 لـ 5 العصر واستمتع بخصم فوري على التوصيل.</p>
                </div>
                <div class="relative z-10 w-32 h-32 shrink-0 bg-yellow-50 rounded-2xl flex items-center justify-center border border-yellow-100 group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-500 shadow-inner">
                    <span class="text-5xl drop-shadow-md">🍔</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- All Services Details Grid -->
<section class="py-20 px-6 md:px-12 bg-white relative">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-black text-[#0B1536] mb-4">قائمة خدماتنا الشاملة</h2>
            <div class="flex items-center justify-center gap-2 mt-4">
                <div class="h-1 w-16 rounded-full bg-[#FFC107]"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $index => $category)
                <x-service-card-detailed :category="$category" :index="$index" />
            @endforeach
            
            <!-- Service: Corporate -->
            <div onclick="window.location.href='tel:01097752649'" data-aos="fade-up" data-aos-delay="600" class="group bg-[#FAFAFA] rounded-[24px] p-8 border border-dashed border-gray-300 hover:border-gray-400 hover:bg-gray-100 transition-all duration-300 flex flex-col items-center justify-center text-center cursor-pointer">
                <div class="w-16 h-16 mb-4 rounded-full bg-white flex items-center justify-center text-gray-400 group-hover:scale-110 group-hover:text-gray-700 transition-all duration-300 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#0B1536] mb-2">خدمات للشركات؟</h3>
                <p class="text-gray-500 text-sm mb-5">نوفر حلول لوجستية وتوصيل مخصصة لأصحاب المتاجر والمطاعم بأسعار خاصة.</p>
                <button class="px-6 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl font-bold group-hover:bg-gray-800 group-hover:text-white transition-colors duration-300 shadow-sm">
                    تواصل معنا
                </button>
            </div>
        </div>
    </div>
</section>

@endsection
