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
    
    /* Smooth Accordion CSS Grid Hack */
    .faq-content {
        display: grid;
        grid-template-rows: 0fr;
        transition: grid-template-rows 0.4s ease-in-out;
    }
    .faq-item.is-open .faq-content {
        grid-template-rows: 1fr;
    }
    .faq-inner-text {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        transition-delay: 0s;
    }
    .faq-item.is-open .faq-inner-text {
        opacity: 1;
        transition-delay: 0.15s; /* Wait slightly for expansion before fading in text */
    }
    .faq-icon {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .faq-item.is-open .faq-icon {
        transform: rotate(-180deg);
        background-color: #FFC107 !important;
        color: white !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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

        <div class="flex flex-col lg:flex-row justify-between relative z-10 gap-x-24">
            
            <!-- Right Column (Questions 1, 3, 5) -->
            <div class="w-full lg:w-[calc(50%-3rem)] space-y-8 lg:space-y-12">
                
                <!-- Question 1 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="100">
                    <!-- Branch connecting to center (Leftwards) -->
                    <div class="hidden lg:block absolute top-12 -left-12 w-12 h-[2px] bg-gradient-to-l from-transparent to-[#FFC107] opacity-50 group-hover:opacity-100 transition-all duration-500"></div>
                    <div class="hidden lg:block absolute top-12 -left-[54px] w-4 h-4 bg-white border-4 border-[#FFC107] rounded-full transform -translate-y-1/2 shadow-[0_0_10px_rgba(255,193,7,0.5)] z-10 group-hover:scale-150 transition-all duration-500"></div>
                    
                    <div class="faq-item bg-white border border-gray-100 rounded-[32px] shadow-sm hover:shadow-xl transition-all duration-300 relative z-20">
                        <button class="faq-button w-full flex justify-between items-center font-bold cursor-pointer p-6 md:p-8 text-[#0B1536] text-lg md:text-xl text-right">
                            <span>كم يستغرق توصيل الطلب؟</span>
                            <div class="faq-icon flex-shrink-0 w-12 h-12 rounded-2xl bg-yellow-50 text-[#FFC107] flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </button>
                        <div class="faq-content">
                            <div class="overflow-hidden">
                                <div class="faq-inner-text px-6 md:px-8 pb-8 pt-0 text-gray-500 leading-relaxed text-lg border-t border-gray-50 mt-2 pt-6">
                                    نحرص في "علي الباب" على توصيل طلباتكم في أسرع وقت ممكن. عادة ما يتم التوصيل في نفس اليوم وخلال ساعات قليلة من تأكيد الطلب، وقد يختلف الوقت قليلاً بناءً على المسافة وظروف الطريق.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="300">
                    <!-- Branch connecting to center (Leftwards) -->
                    <div class="hidden lg:block absolute top-12 -left-12 w-12 h-[2px] bg-gradient-to-l from-transparent to-[#FFC107] opacity-50 group-hover:opacity-100 transition-all duration-500"></div>
                    <div class="hidden lg:block absolute top-12 -left-[54px] w-4 h-4 bg-white border-4 border-[#FFC107] rounded-full transform -translate-y-1/2 shadow-[0_0_10px_rgba(255,193,7,0.5)] z-10 group-hover:scale-150 transition-all duration-500"></div>
                    
                    <div class="faq-item bg-white border border-gray-100 rounded-[32px] shadow-sm hover:shadow-xl transition-all duration-300 relative z-20">
                        <button class="faq-button w-full flex justify-between items-center font-bold cursor-pointer p-6 md:p-8 text-[#0B1536] text-lg md:text-xl text-right">
                            <span>هل يمكنني تتبع حالة طلبي؟</span>
                            <div class="faq-icon flex-shrink-0 w-12 h-12 rounded-2xl bg-yellow-50 text-[#FFC107] flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </button>
                        <div class="faq-content">
                            <div class="overflow-hidden">
                                <div class="faq-inner-text px-6 md:px-8 pb-8 pt-0 text-gray-500 leading-relaxed text-lg border-t border-gray-50 mt-2 pt-6">
                                    بالتأكيد! بمجرد قبول المندوب لطلبك، سيظهر لك رقمه للتواصل معه مباشرة، وتقدر تتابع معاه خط سير طلبك لحد ما يوصل إلى باب بيتك بأمان.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 5 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="500">
                    <!-- Branch connecting to center (Leftwards) -->
                    <div class="hidden lg:block absolute top-12 -left-12 w-12 h-[2px] bg-gradient-to-l from-transparent to-[#FFC107] opacity-50 group-hover:opacity-100 transition-all duration-500"></div>
                    <div class="hidden lg:block absolute top-12 -left-[54px] w-4 h-4 bg-white border-4 border-[#FFC107] rounded-full transform -translate-y-1/2 shadow-[0_0_10px_rgba(255,193,7,0.5)] z-10 group-hover:scale-150 transition-all duration-500"></div>
                    
                    <div class="faq-item bg-white border border-gray-100 rounded-[32px] shadow-sm hover:shadow-xl transition-all duration-300 relative z-20">
                        <button class="faq-button w-full flex justify-between items-center font-bold cursor-pointer p-6 md:p-8 text-[#0B1536] text-lg md:text-xl text-right">
                            <span>ماذا أفعل في حالة مشكلة بالطلب؟</span>
                            <div class="faq-icon flex-shrink-0 w-12 h-12 rounded-2xl bg-yellow-50 text-[#FFC107] flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </button>
                        <div class="faq-content">
                            <div class="overflow-hidden">
                                <div class="faq-inner-text px-6 md:px-8 pb-8 pt-0 text-gray-500 leading-relaxed text-lg border-t border-gray-50 mt-2 pt-6">
                                    رضاك هو أولويتنا. إذا واجهت أي مشكلة بخصوص الطلب أو التوصيل، يرجى التواصل معنا فوراً عبر صفحة "تواصل معنا" وسيقوم فريق الدعم الفني بحل مشكلتك وتعويضك في أسرع وقت.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Left Column (Questions 2, 4) -->
            <div class="w-full lg:w-[calc(50%-3rem)] space-y-8 lg:space-y-12 lg:mt-16 mt-8">
                
                <!-- Question 2 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="200">
                    <!-- Branch connecting to center (Rightwards) -->
                    <div class="hidden lg:block absolute top-12 -right-12 w-12 h-[2px] bg-gradient-to-r from-transparent to-[#FFC107] opacity-50 group-hover:opacity-100 transition-all duration-500"></div>
                    <div class="hidden lg:block absolute top-12 -right-[54px] w-4 h-4 bg-white border-4 border-[#FFC107] rounded-full transform -translate-y-1/2 shadow-[0_0_10px_rgba(255,193,7,0.5)] z-10 group-hover:scale-150 transition-all duration-500"></div>
                    
                    <div class="faq-item bg-white border border-gray-100 rounded-[32px] shadow-sm hover:shadow-xl transition-all duration-300 relative z-20">
                        <button class="faq-button w-full flex justify-between items-center font-bold cursor-pointer p-6 md:p-8 text-[#0B1536] text-lg md:text-xl text-right">
                            <span>ما هي مناطق التوصيل المتاحة؟</span>
                            <div class="faq-icon flex-shrink-0 w-12 h-12 rounded-2xl bg-yellow-50 text-[#FFC107] flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </button>
                        <div class="faq-content">
                            <div class="overflow-hidden">
                                <div class="faq-inner-text px-6 md:px-8 pb-8 pt-0 text-gray-500 leading-relaxed text-lg border-t border-gray-50 mt-2 pt-6">
                                    نحن نقوم بتغطية كافة مناطق المدينة الرئيسية والأحياء المجاورة. إذا كان موقعك خارج نطاق التغطية المعتاد، سيتم إخبارك بذلك أثناء تحديد موقعك على الخريطة قبل إتمام الطلب لضمان الشفافية.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="400">
                    <!-- Branch connecting to center (Rightwards) -->
                    <div class="hidden lg:block absolute top-12 -right-12 w-12 h-[2px] bg-gradient-to-r from-transparent to-[#FFC107] opacity-50 group-hover:opacity-100 transition-all duration-500"></div>
                    <div class="hidden lg:block absolute top-12 -right-[54px] w-4 h-4 bg-white border-4 border-[#FFC107] rounded-full transform -translate-y-1/2 shadow-[0_0_10px_rgba(255,193,7,0.5)] z-10 group-hover:scale-150 transition-all duration-500"></div>
                    
                    <div class="faq-item bg-white border border-gray-100 rounded-[32px] shadow-sm hover:shadow-xl transition-all duration-300 relative z-20">
                        <button class="faq-button w-full flex justify-between items-center font-bold cursor-pointer p-6 md:p-8 text-[#0B1536] text-lg md:text-xl text-right">
                            <span>ما هي طرق الدفع المتاحة؟</span>
                            <div class="faq-icon flex-shrink-0 w-12 h-12 rounded-2xl bg-yellow-50 text-[#FFC107] flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </button>
                        <div class="faq-content">
                            <div class="overflow-hidden">
                                <div class="faq-inner-text px-6 md:px-8 pb-8 pt-0 text-gray-500 leading-relaxed text-lg border-t border-gray-50 mt-2 pt-6">
                                    لسهولة التعامل، نوفر حالياً خدمة "الدفع عند الاستلام" كخيار أساسي ومريح لجميع عملائنا، بحيث تدفع قيمة الطلب والتوصيل نقداً للمندوب عند استلام طلبك والتأكد منه بالكامل.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const faqItems = document.querySelectorAll(".faq-item");
        faqItems.forEach((item) => {
            const button = item.querySelector(".faq-button");
            button.addEventListener("click", () => {
                const isOpen = item.classList.contains("is-open");
                
                // Close all items
                faqItems.forEach(faq => {
                    faq.classList.remove("is-open");
                });

                // Open the clicked item if it wasn't already open
                if (!isOpen) {
                    item.classList.add("is-open");
                }
            });
        });
    });
</script>
@endsection
