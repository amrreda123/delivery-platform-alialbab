<nav class="flex items-center justify-between px-6 md:px-12 py-5 bg-white shadow-sm relative z-20">
    <!-- Right: Logo -->
    <div class="flex items-center gap-2">
        <a href="/" class="flex items-center gap-2">
            <!-- Logo Icon (Door with speed lines) -->
            <svg class="w-10 h-10 text-[#FFC107]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Outer Frame -->
                <path d="M12 3H18C18.5523 3 19 3.44772 19 4V21H12V3Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <!-- Solid Door Leaf -->
                <path d="M12 3L6 5V19L12 21V3Z" fill="currentColor"/>
                <!-- Door Knob -->
                <circle cx="10" cy="12" r="1" fill="white"/>
                <!-- Speed Lines -->
                <path d="M1 12H4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M2 8H5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M2 16H5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <span class="text-3xl font-extrabold text-[#0B1536]">علي الباب <span class="text-[#FFC107]">-</span></span>
        </a>
    </div>

    <!-- Center: Links -->
    <ul class="hidden lg:flex items-center gap-8 font-semibold text-gray-500">
        <li>
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#FFC107] border-b-2 border-[#FFC107] pb-1' : 'hover:text-[#FFC107] transition' }}">الرئيسية</a>
        </li>
        <li>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'text-[#FFC107] border-b-2 border-[#FFC107] pb-1' : 'hover:text-[#FFC107] transition' }}">الخدمات</a>
        </li>
        <li>
            <a href="{{ route('how-it-works') }}" class="{{ request()->routeIs('how-it-works') ? 'text-[#FFC107] border-b-2 border-[#FFC107] pb-1' : 'hover:text-[#FFC107] transition' }}">كيف تعمل</a>
        </li>
        <li>
            <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'text-[#FFC107] border-b-2 border-[#FFC107] pb-1' : 'hover:text-[#FFC107] transition' }}">الأسئلة الشائعة</a>
        </li>
        <li>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-[#FFC107] border-b-2 border-[#FFC107] pb-1' : 'hover:text-[#FFC107] transition' }}">تواصل معنا</a>
        </li>
    </ul>

    <!-- Left: Actions & Mobile Toggle -->
    <div class="flex items-center gap-3 md:gap-6">
        <a href="{{ route('admin.dashboard') }}" 
           class="hidden md:flex font-semibold text-gray-600 hover:text-[#FFC107] transition items-center gap-2 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            لوحة التحكم
        </a>
        <button onclick="document.getElementById('app-modal').classList.remove('hidden')"
                class="bg-[#FFC107] text-[#0B1536] px-4 md:px-6 py-2 md:py-2.5 rounded-xl font-bold shadow-md hover:bg-yellow-500 transition flex items-center gap-2 text-sm md:text-base">
            <svg class="hidden md:block w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            التطبيق
        </button>

        <!-- Mobile Menu Button -->
        <button onclick="document.getElementById('mobile-menu').classList.toggle('translate-x-full')" class="lg:hidden p-2 text-gray-600 hover:text-[#FFC107] transition">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="fixed inset-y-0 right-0 w-64 bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out lg:hidden flex flex-col">
    <div class="p-5 border-b border-gray-100 flex items-center justify-between">
        <span class="text-2xl font-extrabold text-[#0B1536]">علي الباب <span class="text-[#FFC107]">-</span></span>
        <button onclick="document.getElementById('mobile-menu').classList.add('translate-x-full')" class="p-2 text-gray-400 hover:text-red-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <ul class="flex-1 overflow-y-auto py-4 px-6 space-y-4 font-semibold text-gray-600">
        <li><a href="{{ route('home') }}" class="block w-full py-2 {{ request()->routeIs('home') ? 'text-[#FFC107]' : 'hover:text-[#FFC107]' }}">الرئيسية</a></li>
        <li><a href="{{ route('services') }}" class="block w-full py-2 {{ request()->routeIs('services') ? 'text-[#FFC107]' : 'hover:text-[#FFC107]' }}">الخدمات</a></li>
        <li><a href="{{ route('how-it-works') }}" class="block w-full py-2 {{ request()->routeIs('how-it-works') ? 'text-[#FFC107]' : 'hover:text-[#FFC107]' }}">كيف تعمل</a></li>
        <li><a href="{{ route('faq') }}" class="block w-full py-2 {{ request()->routeIs('faq') ? 'text-[#FFC107]' : 'hover:text-[#FFC107]' }}">الأسئلة الشائعة</a></li>
        <li><a href="{{ route('contact') }}" class="block w-full py-2 {{ request()->routeIs('contact') ? 'text-[#FFC107]' : 'hover:text-[#FFC107]' }}">تواصل معنا</a></li>
    </ul>
    <div class="p-6 border-t border-gray-100">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 w-full py-3 bg-gray-50 text-gray-700 rounded-xl font-bold hover:bg-gray-100">
            لوحة التحكم
        </a>
    </div>
</div>

<!-- Modal: Not Available Yet -->
<div id="app-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="document.getElementById('app-modal').classList.add('hidden')"></div>
    <!-- Modal Box -->
    <div class="relative bg-white rounded-3xl shadow-2xl px-10 py-10 flex flex-col items-center gap-5 max-w-sm w-full mx-4 z-10">
        <!-- Icon -->
        <div class="w-20 h-20 bg-[#FFF8E1] rounded-full flex items-center justify-center">
            <svg class="w-10 h-10 text-[#FFC107]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h3 class="text-2xl font-black text-[#0B1536]">قريباً!</h3>
        <p class="text-gray-500 text-center text-base leading-relaxed">
            التطبيق غير متوفر الآن<br>
            نعمل على إطلاقه في أقرب وقت 🚀
        </p>
        <button onclick="document.getElementById('app-modal').classList.add('hidden')"
                class="bg-[#FFC107] text-[#0B1536] px-8 py-3 rounded-xl font-bold hover:bg-yellow-500 transition w-full">
            حسناً
        </button>
    </div>
</div>
