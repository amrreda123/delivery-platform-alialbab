@extends('layouts.app')

@section('content')

<!-- Custom Animations -->
<style>
    @keyframes ken-burns {
        0% { transform: scale(1); }
        100% { transform: scale(1.1) translate(-1%, -1%); }
    }
    .animate-ken-burns {
        animation: ken-burns 20s ease-in-out infinite alternate;
    }
</style>

<!-- Header Section -->
<div class="relative pt-32 pb-24 overflow-hidden border-b border-gray-100 flex items-center justify-center min-h-[400px]">
    <!-- Animated Background Image -->
    <div class="absolute inset-0 w-full h-full z-0 overflow-hidden">
        <img src="{{ asset('images/delivery.jpg') }}" alt="Delivery Background" class="absolute inset-0 w-full h-full object-cover object-center animate-ken-burns">
        <!-- Overlays for readability -->
        <div class="absolute inset-0 bg-white/60 backdrop-blur-[3px]"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/30 to-[#FAFAFA]"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 md:px-12 text-center z-10" data-aos="fade-down" data-aos-duration="1000">
        <span class="inline-block px-5 py-2 rounded-full bg-white text-[#B45309] font-bold text-sm mb-6 border border-yellow-200 shadow-sm hover:scale-110 transition-all duration-300 cursor-default">
            دليل الاستخدام
        </span>
        <h1 class="text-4xl md:text-5xl font-black text-[#0B1536] mb-6 leading-tight hover:scale-105 transition-transform duration-500">
            كيف تطلب من <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FFC107] to-[#F59E0B]">علي الباب؟</span>
        </h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed">
            خطوات بسيطة وسريعة لتوصيل أي شيء تحتاجه لباب بيتك. شاهد الفيديو أو اقرأ الخطوات بالأسفل.
        </p>
    </div>
</div>

<!-- Custom Animation Styles for Tree Layout -->
<style>
    @keyframes centerToLeft {
        0% { transform: translate3d(30vw, 0, 0) scale(1.1); opacity: 0; }
        20% { transform: translate3d(30vw, 0, 0) scale(1.1); opacity: 1; }
        100% { transform: translate3d(0, 0, 0) scale(1); opacity: 1; }
    }
    .animate-root {
        animation: centerToLeft 2s cubic-bezier(0.25, 1, 0.5, 1) forwards;
    }

    @keyframes drawPath {
        0% { stroke-dashoffset: 100; }
        100% { stroke-dashoffset: 0; }
    }
    .animate-svg-path {
        stroke-dasharray: 100;
        stroke-dashoffset: 100;
        animation: drawPath 1.5s ease-out forwards;
    }

    @keyframes popIn {
        0% { opacity: 0; transform: translateX(30px) scale(0.9); }
        100% { opacity: 1; transform: translateX(0) scale(1); }
    }
    .animate-node-1 { opacity: 0; animation: popIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) 1.8s forwards; }
    .animate-node-2 { opacity: 0; animation: popIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) 2.1s forwards; }
    .animate-node-3 { opacity: 0; animation: popIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) 2.4s forwards; }
</style>

<!-- Branching Features Section -->
<section class="py-32 bg-[#FAFAFA] relative z-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-12 relative">
        <div class="text-center mb-24" data-aos="fade-down">
            <span class="inline-block px-4 py-1.5 rounded-full bg-yellow-100 text-yellow-700 font-bold text-sm mb-4 border border-yellow-200">
                كيف نعمل
            </span>
            <h2 class="text-4xl md:text-5xl font-black text-[#0B1536]">طريقة عمل <span class="text-[#FFC107]">علي الباب</span></h2>
        </div>

        <div class="relative flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-0 min-h-[450px]">
            
            <!-- SVG Connecting Branches (Desktop Only) -->
            <div class="hidden lg:block absolute top-0 left-0 w-full h-full pointer-events-none z-0" dir="ltr">
                <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <!-- Path 1: Speed -->
                    <path d="M 40 50 C 45 50, 50 15, 60 15" fill="none" stroke="#FFC107" stroke-width="0.5" class="animate-svg-path" vector-effect="non-scaling-stroke" style="animation-delay: 1.5s;" />
                    <!-- Path 2: Safety -->
                    <path d="M 40 50 L 60 50" fill="none" stroke="#3B82F6" stroke-width="0.5" class="animate-svg-path" vector-effect="non-scaling-stroke" style="animation-delay: 1.8s;" />
                    <!-- Path 3: Ease -->
                    <path d="M 40 50 C 45 50, 50 85, 60 85" fill="none" stroke="#14B8A6" stroke-width="0.5" class="animate-svg-path" vector-effect="non-scaling-stroke" style="animation-delay: 2.1s;" />
                </svg>
            </div>

            <!-- Right Column: Features (The Branches) -->
            <div class="w-full lg:w-[45%] flex flex-col justify-between h-[450px] relative z-10">
                
                <!-- Feature 1: Speed -->
                <div class="animate-node-1 bg-white p-6 rounded-[24px] shadow-lg border-l-4 border-[#FFC107] flex items-center gap-6 relative transform transition-all hover:scale-105 hover:shadow-2xl hover:-translate-y-1">
                    <div class="hidden lg:block absolute top-1/2 -left-3 transform -translate-y-1/2 w-6 h-6 bg-white rounded-full border-4 border-[#FFC107]"></div>
                    <div class="w-16 h-16 rounded-2xl bg-yellow-50 flex items-center justify-center text-[#FFC107] shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-[#0B1536]">سرعة فائقة في التوصيل</h4>
                        <p class="text-gray-500 text-sm mt-1">بنوصلك كل طلباتك في أسرع وقت في نفس اليوم.</p>
                    </div>
                </div>

                <!-- Feature 2: Safety -->
                <div class="animate-node-2 bg-white p-6 rounded-[24px] shadow-lg border-l-4 border-[#3B82F6] flex items-center gap-6 relative transform transition-all hover:scale-105 hover:shadow-2xl hover:-translate-y-1">
                    <div class="hidden lg:block absolute top-1/2 -left-3 transform -translate-y-1/2 w-6 h-6 bg-white rounded-full border-4 border-[#3B82F6]"></div>
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-[#3B82F6] shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-[#0B1536]">ثقة وأمان تام</h4>
                        <p class="text-gray-500 text-sm mt-1">مندوبين محترفين وأمانة تامة في التعامل.</p>
                    </div>
                </div>

                <!-- Feature 3: Ease -->
                <div class="animate-node-3 bg-white p-6 rounded-[24px] shadow-lg border-l-4 border-[#14B8A6] flex items-center gap-6 relative transform transition-all hover:scale-105 hover:shadow-2xl hover:-translate-y-1">
                    <div class="hidden lg:block absolute top-1/2 -left-3 transform -translate-y-1/2 w-6 h-6 bg-white rounded-full border-4 border-[#14B8A6]"></div>
                    <div class="w-16 h-16 rounded-2xl bg-teal-50 flex items-center justify-center text-[#14B8A6] shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-[#0B1536]">سهولة وراحة</h4>
                        <p class="text-gray-500 text-sm mt-1">واجهة بسيطة تخليك تطلب في ثواني.</p>
                    </div>
                </div>
            </div>

            <!-- Left Column: Video (The Root) -->
            <div class="w-full lg:w-[40%] relative z-10 animate-root mt-12 lg:mt-0">
                <div class="bg-white p-3 rounded-[40px] shadow-[0_20px_50px_rgba(8,_112,_184,_0.1)] border border-gray-100 relative group">
                    <!-- Glow -->
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#FFC107] to-[#3B82F6] rounded-[48px] blur-xl opacity-30 group-hover:opacity-60 transition duration-1000"></div>
                    
                    <div class="relative w-full overflow-hidden rounded-[32px] bg-gray-900" style="padding-top: 100%;">
                        <iframe class="absolute top-0 left-0 w-full h-full object-cover" 
                                src="https://www.youtube.com/embed/q0mqhABWbRs?autoplay=0&rel=0" 
                                title="شرح استخدام موقع علي الباب" 
                                frameborder="0" allowfullscreen>
                        </iframe>
                    </div>
                    
                    <!-- Root Node Connector -->
                    <div class="hidden lg:flex absolute top-1/2 -right-6 transform -translate-y-1/2 w-12 h-12 bg-white rounded-full border-4 border-[#0B1536] shadow-xl items-center justify-center z-20">
                        <div class="w-4 h-4 bg-[#FFC107] rounded-full animate-ping"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Steps Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-black text-[#0B1536] mb-4">خطوات الطلب بالتفصيل</h2>
            <div class="h-1 w-20 bg-[#FFC107] mx-auto rounded-full"></div>
            <p class="text-gray-500 mt-5 text-base max-w-lg mx-auto leading-relaxed">
                سواء كنت بتطلب أكل، أو مشتريات من السوبر ماركت، أو حتى بتوصل غرض من مكان لمكان.. العملية بسيطة جداً:
            </p>
        </div>

        <div class="relative mt-12">
            <!-- Connecting Line (Desktop Only) -->
            <div class="hidden lg:block absolute top-[48px] right-[12%] left-[12%] h-[2px] bg-gradient-to-r from-transparent via-[#FFC107] to-transparent opacity-30 z-0 border-t-2 border-dashed border-[#FFC107]"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 relative z-10">
                
                <!-- Step 1 -->
                <div data-aos="fade-up" data-aos-delay="100" class="relative group flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-white rounded-full border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] flex items-center justify-center mb-6 relative group-hover:-translate-y-2 transition-all duration-500">
                        <div class="absolute inset-1.5 rounded-full border border-dashed border-yellow-300 opacity-0 group-hover:opacity-100 group-hover:animate-[spin_8s_linear_infinite] transition-opacity duration-500"></div>
                        <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-600 group-hover:bg-yellow-100 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="absolute -top-1 -right-1 w-8 h-8 bg-[#0B1536] text-white rounded-full flex items-center justify-center font-black text-sm border-4 border-white shadow-sm">1</div>
                    </div>
                    <h3 class="text-xl font-bold text-[#0B1536] mb-3 group-hover:text-yellow-600 transition-colors">اختر نوع التوصيل</h3>
                    <p class="text-gray-500 text-sm leading-relaxed px-4">
                        من الصفحة الرئيسية، حدد نوع الخدمة اللي محتاجها: مطاعم، سوبر ماركت، أو حتى "توصيل أي غرض" لحاجاتك المخصصة.
                    </p>
                </div>

                <!-- Step 2 -->
                <div data-aos="fade-up" data-aos-delay="200" class="relative group flex flex-col items-center text-center mt-8 md:mt-0">
                    <div class="w-24 h-24 bg-white rounded-full border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] flex items-center justify-center mb-6 relative group-hover:-translate-y-2 transition-all duration-500">
                        <div class="absolute inset-1.5 rounded-full border border-dashed border-yellow-300 opacity-0 group-hover:opacity-100 group-hover:animate-[spin_8s_linear_infinite] transition-opacity duration-500"></div>
                        <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-600 group-hover:bg-yellow-100 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="absolute -top-1 -right-1 w-8 h-8 bg-[#0B1536] text-white rounded-full flex items-center justify-center font-black text-sm border-4 border-white shadow-sm">2</div>
                    </div>
                    <h3 class="text-xl font-bold text-[#0B1536] mb-3 group-hover:text-yellow-600 transition-colors">حدد المكان والتفاصيل</h3>
                    <p class="text-gray-500 text-sm leading-relaxed px-4">
                        اكتب عنوان الاستلام والتسليم بدقة. تقدر كمان تحدد موقعك على الخريطة مباشرة عشان نضمن وصول سريع.
                    </p>
                </div>

                <!-- Step 3 -->
                <div data-aos="fade-up" data-aos-delay="300" class="relative group flex flex-col items-center text-center mt-8 lg:mt-0">
                    <div class="w-24 h-24 bg-white rounded-full border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] flex items-center justify-center mb-6 relative group-hover:-translate-y-2 transition-all duration-500">
                        <div class="absolute inset-1.5 rounded-full border border-dashed border-yellow-300 opacity-0 group-hover:opacity-100 group-hover:animate-[spin_8s_linear_infinite] transition-opacity duration-500"></div>
                        <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-600 group-hover:bg-yellow-100 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <div class="absolute -top-1 -right-1 w-8 h-8 bg-[#0B1536] text-white rounded-full flex items-center justify-center font-black text-sm border-4 border-white shadow-sm">3</div>
                    </div>
                    <h3 class="text-xl font-bold text-[#0B1536] mb-3 group-hover:text-yellow-600 transition-colors">اكتب ملاحظاتك</h3>
                    <p class="text-gray-500 text-sm leading-relaxed px-4">
                        عندك طلبات خاصة؟ محتاج المندوب يشتري حاجة معينة؟ اكتب كل تفاصيل الطلب بوضوح عشان ننفذه بالحرف.
                    </p>
                </div>

                <!-- Step 4 -->
                <div data-aos="fade-up" data-aos-delay="400" class="relative group flex flex-col items-center text-center mt-8 lg:mt-0">
                    <div class="w-24 h-24 bg-white rounded-full border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] flex items-center justify-center mb-6 relative group-hover:-translate-y-2 transition-all duration-500">
                        <div class="absolute inset-1.5 rounded-full border border-dashed border-yellow-300 opacity-0 group-hover:opacity-100 group-hover:animate-[spin_8s_linear_infinite] transition-opacity duration-500"></div>
                        <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-600 group-hover:bg-yellow-100 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div class="absolute -top-1 -right-1 w-8 h-8 bg-[#0B1536] text-white rounded-full flex items-center justify-center font-black text-sm border-4 border-white shadow-sm">4</div>
                    </div>
                    <h3 class="text-xl font-bold text-[#0B1536] mb-3 group-hover:text-yellow-600 transition-colors">تتبع واستلم</h3>
                    <p class="text-gray-500 text-sm leading-relaxed px-4">
                        أكد الطلب وتابع حالة طلبك لحظة بلحظة. المندوب هيتواصل معاك ويوصلك طلبك لحد باب بيتك في نفس اليوم.
                    </p>
                </div>

            </div>
        </div>
        
        <div class="mt-16 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 bg-[#0B1536] text-white px-8 py-4 rounded-xl font-bold hover:bg-gray-800 transition shadow-xl">
                ابدأ طلبك الآن
                <svg class="w-5 h-5 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
</section>

@endsection
