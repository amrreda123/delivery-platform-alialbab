@extends('layouts.app')

@section('title', 'الأسئلة الشائعة - علي الباب')

@section('content')
<style>
    @keyframes ken-burns {
        0% { transform: scale(1); }
        100% { transform: scale(1.1) translate(-1%, -1%); }
    }
    .animate-ken-burns {
        animation: ken-burns 20s ease-in-out infinite alternate;
    }
    
    /* Hide default marker */
    details > summary { list-style: none; outline: none; }
    details > summary::-webkit-details-marker { display: none; }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
</style>

<!-- Header Section with Image Background -->
<div class="relative pt-32 pb-24 overflow-hidden border-b border-gray-100 flex items-center justify-center min-h-[400px]">
    <!-- Animated Background Image -->
    <div class="absolute inset-0 w-full h-full z-0 overflow-hidden">
        <img src="{{ asset('images/delivery.jpg') }}" alt="FAQ Background" class="absolute inset-0 w-full h-full object-cover object-center animate-ken-burns">
        <!-- Overlays for readability -->
        <div class="absolute inset-0 bg-white/60 backdrop-blur-[5px]"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/40 to-[#FAFAFA]"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 md:px-12 text-center z-10" data-aos="fade-down" data-aos-duration="1000">
        <span class="inline-block px-5 py-2 rounded-full bg-white text-[#B45309] font-bold text-sm mb-6 border border-yellow-200 shadow-sm hover:scale-110 transition-all duration-300 cursor-default">
            مركز المساعدة
        </span>
        <h1 class="text-4xl md:text-5xl font-black text-[#0B1536] mb-6 leading-tight hover:scale-105 transition-transform duration-500">
            الأسئلة <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FFC107] to-[#F59E0B]">الشائعة</span>
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed font-medium">
            كل الإجابات اللي بتدور عليها جمعناها هنا عشان تجربتك معانا تكون أسهل وأسرع.
        </p>
    </div>
</div>

<!-- Tree Branch Layout Accordion Section -->
<section class="py-24 bg-[#FAFAFA] relative z-20 overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 md:px-12 relative">
        
        <!-- Central Tree Trunk -->
        <div class="hidden lg:block absolute top-0 left-1/2 transform -translate-x-1/2 w-[2px] h-full bg-gradient-to-b from-[#FFC107] via-yellow-300 to-transparent z-0 opacity-50"></div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-24 gap-y-8 lg:gap-y-0 relative z-10">
            
            <!-- Question 1 (Right Column) -->
            <div class="relative group" data-aos="fade-up" data-aos-delay="100">
                <!-- Branch connecting to center (Leftwards) -->
                <div class="hidden lg:block absolute top-12 -left-12 w-12 h-[2px] bg-gradient-to-l from-transparent to-[#FFC107] opacity-50 group-hover:opacity-100 transition-all duration-500"></div>
                <div class="hidden lg:block absolute top-12 -left-[54px] w-4 h-4 bg-white border-4 border-[#FFC107] rounded-full transform -translate-y-1/2 shadow-[0_0_10px_rgba(255,193,7,0.5)] z-10 group-hover:scale-150 transition-all duration-500"></div>
                
                <details name="faq" class="bg-white border border-gray-100 rounded-[32px] shadow-sm hover:shadow-xl transition-all duration-300 relative z-20">
                    <summary class="flex justify-between items-center font-bold cursor-pointer p-6 md:p-8 text-[#0B1536] text-lg md:text-xl">
                        <span>كم يستغرق توصيل الطلب؟</span>
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-yellow-50 text-[#FFC107] flex items-center justify-center transition-all duration-300 group-open:-rotate-180 group-open:bg-[#FFC107] group-open:text-white group-open:shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </summary>
                    <div class="px-6 md:px-8 pb-8 pt-0 text-gray-500 leading-relaxed text-lg animate-fade-in border-t border-gray-50 mt-2 pt-6">
                        نحرص في "علي الباب" على توصيل طلباتكم في أسرع وقت ممكن. عادة ما يتم التوصيل في نفس اليوم وخلال ساعات قليلة من تأكيد الطلب، وقد يختلف الوقت قليلاً بناءً على المسافة وظروف الطريق.
                    </div>
                </details>
            </div>

            <!-- Question 2 (Left Column) -->
            <div class="relative group lg:mt-32" data-aos="fade-up" data-aos-delay="200">
                <!-- Branch connecting to center (Rightwards) -->
                <div class="hidden lg:block absolute top-12 -right-12 w-12 h-[2px] bg-gradient-to-r from-transparent to-[#FFC107] opacity-50 group-hover:opacity-100 transition-all duration-500"></div>
                <div class="hidden lg:block absolute top-12 -right-[54px] w-4 h-4 bg-white border-4 border-[#FFC107] rounded-full transform -translate-y-1/2 shadow-[0_0_10px_rgba(255,193,7,0.5)] z-10 group-hover:scale-150 transition-all duration-500"></div>
                
                <details name="faq" class="bg-white border border-gray-100 rounded-[32px] shadow-sm hover:shadow-xl transition-all duration-300 relative z-20">
                    <summary class="flex justify-between items-center font-bold cursor-pointer p-6 md:p-8 text-[#0B1536] text-lg md:text-xl">
                        <span>ما هي مناطق التوصيل المتاحة؟</span>
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-yellow-50 text-[#FFC107] flex items-center justify-center transition-all duration-300 group-open:-rotate-180 group-open:bg-[#FFC107] group-open:text-white group-open:shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </summary>
                    <div class="px-6 md:px-8 pb-8 pt-0 text-gray-500 leading-relaxed text-lg animate-fade-in border-t border-gray-50 mt-2 pt-6">
                        نحن نقوم بتغطية كافة مناطق المدينة الرئيسية والأحياء المجاورة. إذا كان موقعك خارج نطاق التغطية المعتاد، سيتم إخبارك بذلك أثناء تحديد موقعك على الخريطة قبل إتمام الطلب لضمان الشفافية.
                    </div>
                </details>
            </div>

            <!-- Question 3 (Right Column) -->
            <div class="relative group lg:-mt-16" data-aos="fade-up" data-aos-delay="300">
                <!-- Branch connecting to center (Leftwards) -->
                <div class="hidden lg:block absolute top-12 -left-12 w-12 h-[2px] bg-gradient-to-l from-transparent to-[#FFC107] opacity-50 group-hover:opacity-100 transition-all duration-500"></div>
                <div class="hidden lg:block absolute top-12 -left-[54px] w-4 h-4 bg-white border-4 border-[#FFC107] rounded-full transform -translate-y-1/2 shadow-[0_0_10px_rgba(255,193,7,0.5)] z-10 group-hover:scale-150 transition-all duration-500"></div>
                
                <details name="faq" class="bg-white border border-gray-100 rounded-[32px] shadow-sm hover:shadow-xl transition-all duration-300 relative z-20">
                    <summary class="flex justify-between items-center font-bold cursor-pointer p-6 md:p-8 text-[#0B1536] text-lg md:text-xl">
                        <span>هل يمكنني تتبع حالة طلبي؟</span>
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-yellow-50 text-[#FFC107] flex items-center justify-center transition-all duration-300 group-open:-rotate-180 group-open:bg-[#FFC107] group-open:text-white group-open:shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </summary>
                    <div class="px-6 md:px-8 pb-8 pt-0 text-gray-500 leading-relaxed text-lg animate-fade-in border-t border-gray-50 mt-2 pt-6">
                        بالتأكيد! بمجرد قبول المندوب لطلبك، سيظهر لك رقمه للتواصل معه مباشرة، وتقدر تتابع معاه خط سير طلبك لحد ما يوصل إلى باب بيتك بأمان.
                    </div>
                </details>
            </div>

            <!-- Question 4 (Left Column) -->
            <div class="relative group lg:mt-16" data-aos="fade-up" data-aos-delay="400">
                <!-- Branch connecting to center (Rightwards) -->
                <div class="hidden lg:block absolute top-12 -right-12 w-12 h-[2px] bg-gradient-to-r from-transparent to-[#FFC107] opacity-50 group-hover:opacity-100 transition-all duration-500"></div>
                <div class="hidden lg:block absolute top-12 -right-[54px] w-4 h-4 bg-white border-4 border-[#FFC107] rounded-full transform -translate-y-1/2 shadow-[0_0_10px_rgba(255,193,7,0.5)] z-10 group-hover:scale-150 transition-all duration-500"></div>
                
                <details name="faq" class="bg-white border border-gray-100 rounded-[32px] shadow-sm hover:shadow-xl transition-all duration-300 relative z-20">
                    <summary class="flex justify-between items-center font-bold cursor-pointer p-6 md:p-8 text-[#0B1536] text-lg md:text-xl">
                        <span>ما هي طرق الدفع المتاحة؟</span>
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-yellow-50 text-[#FFC107] flex items-center justify-center transition-all duration-300 group-open:-rotate-180 group-open:bg-[#FFC107] group-open:text-white group-open:shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </summary>
                    <div class="px-6 md:px-8 pb-8 pt-0 text-gray-500 leading-relaxed text-lg animate-fade-in border-t border-gray-50 mt-2 pt-6">
                        لسهولة التعامل، نوفر حالياً خدمة "الدفع عند الاستلام" كخيار أساسي ومريح لجميع عملائنا، بحيث تدفع قيمة الطلب والتوصيل نقداً للمندوب عند استلام طلبك والتأكد منه بالكامل.
                    </div>
                </details>
            </div>

            <!-- Question 5 (Right Column) -->
            <div class="relative group lg:-mt-16" data-aos="fade-up" data-aos-delay="500">
                <!-- Branch connecting to center (Leftwards) -->
                <div class="hidden lg:block absolute top-12 -left-12 w-12 h-[2px] bg-gradient-to-l from-transparent to-[#FFC107] opacity-50 group-hover:opacity-100 transition-all duration-500"></div>
                <div class="hidden lg:block absolute top-12 -left-[54px] w-4 h-4 bg-white border-4 border-[#FFC107] rounded-full transform -translate-y-1/2 shadow-[0_0_10px_rgba(255,193,7,0.5)] z-10 group-hover:scale-150 transition-all duration-500"></div>
                
                <details name="faq" class="bg-white border border-gray-100 rounded-[32px] shadow-sm hover:shadow-xl transition-all duration-300 relative z-20">
                    <summary class="flex justify-between items-center font-bold cursor-pointer p-6 md:p-8 text-[#0B1536] text-lg md:text-xl">
                        <span>ماذا أفعل في حالة مشكلة بالطلب؟</span>
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-yellow-50 text-[#FFC107] flex items-center justify-center transition-all duration-300 group-open:-rotate-180 group-open:bg-[#FFC107] group-open:text-white group-open:shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </summary>
                    <div class="px-6 md:px-8 pb-8 pt-0 text-gray-500 leading-relaxed text-lg animate-fade-in border-t border-gray-50 mt-2 pt-6">
                        رضاك هو أولويتنا. إذا واجهت أي مشكلة بخصوص الطلب أو التوصيل، يرجى التواصل معنا فوراً عبر صفحة "تواصل معنا" وسيقوم فريق الدعم الفني بحل مشكلتك وتعويضك في أسرع وقت.
                    </div>
                </details>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const faqs = document.querySelectorAll("details[name='faq']");
        faqs.forEach((faq) => {
            faq.addEventListener("click", (e) => {
                if (!faq.hasAttribute("open")) {
                    faqs.forEach((otherFaq) => {
                        if (otherFaq !== faq) {
                            otherFaq.removeAttribute("open");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
