@props(['category', 'index' => 0])

@php
    $delay = ($index + 1) * 100;
    
    // Rotating themes for dynamic categories
    $themes = [
        ['bgHover' => 'from-[#f5f2f9] to-[#ede9f6]', 'iconBg' => 'from-[#8B5CF6] to-[#7C3AED]', 'shadow' => 'shadow-purple-100/60', 'barBg' => 'from-[#8B5CF6] to-[#7C3AED]'],
        ['bgHover' => 'from-[#fff7f0] to-[#fff0e6]', 'iconBg' => 'from-[#F97316] to-[#EA580C]', 'shadow' => 'shadow-orange-100/60', 'barBg' => 'from-[#F97316] to-[#EA580C]'],
        ['bgHover' => 'from-[#f0fdfb] to-[#e6f9f7]', 'iconBg' => 'from-[#14B8A6] to-[#0D9488]', 'shadow' => 'shadow-teal-100/60', 'barBg' => 'from-[#14B8A6] to-[#0D9488]'],
        ['bgHover' => 'from-[#eff6ff] to-[#e8f0fe]', 'iconBg' => 'from-[#3B82F6] to-[#2563EB]', 'shadow' => 'shadow-blue-100/60', 'barBg' => 'from-[#3B82F6] to-[#2563EB]'],
        ['bgHover' => 'from-[#fffbeb] to-[#fef3c7]', 'iconBg' => 'from-[#FFC107] to-[#F59E0B]', 'shadow' => 'shadow-yellow-100/60', 'barBg' => 'from-[#FFC107] to-[#F59E0B]'],
    ];

    $theme = $themes[$index % count($themes)];
    $bgHover = $theme['bgHover'];
    $iconBg  = $theme['iconBg'];
    $shadow  = $theme['shadow'];
    $barBg   = $theme['barBg'];
    $subtitle = 'نوصل أي شيء تريده';

    $isUploaded = $category->icon && str_contains($category->icon, '/');

    if ($isUploaded) {
        $iconHtml = '<div class="w-20 h-20 mb-5 rounded-2xl overflow-hidden group-hover:scale-110 transition-transform duration-300 shadow-lg border-2 border-white"><img src="' . asset('storage/' . $category->icon) . '" class="w-full h-full object-cover bg-white"></div>';
    } else {
        // Fallback for old seeded hardcoded names
        switch($category->icon) {
            case 'clothes-icon':
                $svg = '<svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.57a1 1 0 00.99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.57a2 2 0 00-1.34-2.23z"/></svg>';
                $subtitle = 'من جميع المتاجر';
                break;
            case 'restaurant-icon':
                $svg = '<svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>';
                $subtitle = 'أطيب الأكل، لباب بيتك';
                break;
            case 'pharmacy-icon':
                $svg = '<svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="4"/><path d="M12 8v8M8 12h8"/></svg>';
                $subtitle = 'دواؤك يوصلك بسرعة';
                break;
            case 'supermarket-icon':
                $svg = '<svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 001.94-1.5l1.32-6.5H6"/></svg>';
                $subtitle = 'كل احتياجاتك اليومية';
                break;
            default:
                $svg = '<svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>';
                break;
        }
        $iconHtml = '<div class="w-20 h-20 mb-5 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md bg-gradient-to-br ' . $iconBg . '">' . $svg . '</div>';
    }
@endphp

<a href="{{ route('order.create', $category->id) }}" data-aos="fade-up" data-aos-delay="{{ $delay }}" class="service-card group relative bg-white rounded-[24px] p-6 flex flex-col items-center text-center cursor-pointer border border-gray-100/80 hover:-translate-y-2 hover:shadow-2xl hover:{{ $shadow }} transition-all duration-300 overflow-hidden block">
    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-[24px] bg-gradient-to-br {{ $bgHover }}"></div>
    <div class="relative z-10 flex flex-col items-center w-full">
        {!! $iconHtml !!}
        <h3 class="font-bold text-base text-[#0B1536] mb-1.5 leading-tight w-full truncate">{{ $category->name }}</h3>
        <p class="text-xs text-gray-400 font-medium mb-4 leading-relaxed">{{ $subtitle }}</p>
        <div class="w-10 h-1 rounded-full transition-all duration-300 group-hover:w-16 bg-gradient-to-r {{ $barBg }}"></div>
    </div>
</a>
