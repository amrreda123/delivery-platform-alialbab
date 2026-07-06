@extends('layouts.app')

@section('title', 'تواصل معنا - علي الباب')

@section('content')
<style>
    @keyframes ken-burns {
        0% { transform: scale(1); }
        100% { transform: scale(1.1) translate(-1%, -1%); }
    }
    .animate-ken-burns {
        animation: ken-burns 20s ease-in-out infinite alternate;
    }
</style>

<!-- Header Section with Image Background -->
<div class="relative pt-32 pb-24 overflow-hidden border-b border-gray-100 flex items-center justify-center min-h-[400px]">
    <!-- Animated Background Image -->
    <div class="absolute inset-0 w-full h-full z-0 overflow-hidden">
        <img src="{{ asset('images/delivery.jpg') }}" alt="Contact Background" class="absolute inset-0 w-full h-full object-cover object-center animate-ken-burns">
        <!-- Overlays for readability -->
        <div class="absolute inset-0 bg-white/60 backdrop-blur-[5px]"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/40 to-[#FAFAFA]"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 md:px-12 text-center z-10" data-aos="fade-down" data-aos-duration="1000">
        <span class="inline-block px-5 py-2 rounded-full bg-white text-[#B45309] font-bold text-sm mb-6 border border-yellow-200 shadow-sm hover:scale-110 transition-all duration-300 cursor-default">
            دعم فني متاح دائماً
        </span>
        <h1 class="text-4xl md:text-5xl font-black text-[#0B1536] mb-6 tracking-tight hover:scale-105 transition-transform duration-500">
            تواصل <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FFC107] to-[#F59E0B]">معنا</span>
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed font-medium">
            موجودين عشان نسمعك ونساعدك في أي وقت. اختار المنصة اللي تناسبك وكلمنا فوراً.
        </p>
    </div>
</div>

<!-- Simple & Friendly Contact Grid -->
<section class="py-20 bg-[#FAFAFA] relative z-20">
    <div class="max-w-5xl mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- WhatsApp -->
            <a href="#" target="_blank" class="flex items-center gap-6 p-6 bg-white rounded-[24px] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 rounded-2xl bg-[#25D366]/10 flex items-center justify-center text-[#25D366] group-hover:bg-[#25D366] group-hover:text-white transition-colors duration-300 shrink-0">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 21.688c-1.579 0-3.136-.425-4.5-1.229l-5.006 1.314 1.336-4.882c-.882-1.423-1.348-3.056-1.348-4.739 0-4.996 4.066-9.062 9.063-9.062 4.997 0 9.062 4.066 9.062 9.062 0 4.995-4.065 9.062-9.062 9.062zm-4.97-3.411c1.442.855 3.09 1.306 4.802 1.306 4.148 0 7.525-3.376 7.525-7.525 0-4.148-3.377-7.524-7.525-7.524-4.149 0-7.525 3.376-7.525 7.524 0 1.636.425 3.193 1.228 4.566l-1.026 3.748 3.842-1.009zm6.657-2.607c-.198-.1-1.171-.579-1.353-.645-.181-.067-.314-.1-.447.1-.132.198-.512.645-.628.777-.116.132-.232.148-.43.049-1.583-.787-2.738-1.748-3.791-3.528-.116-.198-.012-.305.087-.404.089-.089.198-.231.298-.347.1-.116.132-.198.198-.33.066-.132.033-.248-.016-.347-.05-.1-.447-1.076-.612-1.472-.161-.385-.325-.333-.447-.339l-.38-.006c-.132 0-.347.05-.53.248-.182.198-.695.678-.695 1.654 0 .976.711 1.919.81 2.05.1.132 1.398 2.134 3.388 2.993 1.832.791 2.455.772 3.031.65.656-.139 1.171-.479 1.336-1.042.165-.562.165-1.042.116-1.141-.05-.1-.182-.149-.38-.248z"/></svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-[#0B1536] text-xl mb-1">واتساب</h3>
                    <p class="text-gray-500 text-sm">أسرع طريقة للتواصل معنا</p>
                </div>
                <div class="text-gray-300 group-hover:text-[#25D366] group-hover:-translate-x-1 transition-all">
                    <svg class="w-6 h-6 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>

            <!-- Facebook -->
            <a href="#" target="_blank" class="flex items-center gap-6 p-6 bg-white rounded-[24px] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 rounded-2xl bg-[#1877F2]/10 flex items-center justify-center text-[#1877F2] group-hover:bg-[#1877F2] group-hover:text-white transition-colors duration-300 shrink-0">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-[#0B1536] text-xl mb-1">فيسبوك</h3>
                    <p class="text-gray-500 text-sm">تابع أخبارنا وعروضنا الحصرية</p>
                </div>
                <div class="text-gray-300 group-hover:text-[#1877F2] group-hover:-translate-x-1 transition-all">
                    <svg class="w-6 h-6 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>

            <!-- Instagram -->
            <a href="#" target="_blank" class="flex items-center gap-6 p-6 bg-white rounded-[24px] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 rounded-2xl bg-[#E1306C]/10 flex items-center justify-center text-[#E1306C] group-hover:bg-[#E1306C] group-hover:text-white transition-colors duration-300 shrink-0">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-[#0B1536] text-xl mb-1">انستجرام</h3>
                    <p class="text-gray-500 text-sm">يوميات وصور لطلباتنا</p>
                </div>
                <div class="text-gray-300 group-hover:text-[#E1306C] group-hover:-translate-x-1 transition-all">
                    <svg class="w-6 h-6 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>

            <!-- YouTube -->
            <a href="#" target="_blank" class="flex items-center gap-6 p-6 bg-white rounded-[24px] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 rounded-2xl bg-[#FF0000]/10 flex items-center justify-center text-[#FF0000] group-hover:bg-[#FF0000] group-hover:text-white transition-colors duration-300 shrink-0">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-[#0B1536] text-xl mb-1">يوتيوب</h3>
                    <p class="text-gray-500 text-sm">شروحات فيديو تفصيلية</p>
                </div>
                <div class="text-gray-300 group-hover:text-[#FF0000] group-hover:-translate-x-1 transition-all">
                    <svg class="w-6 h-6 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>
            
        </div>
    </div>
</section>
@endsection
