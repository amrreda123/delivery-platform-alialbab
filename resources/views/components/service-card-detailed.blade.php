@props(['category', 'index' => 0])

@php
    $delay = ($index + 1) * 100;
    switch($category->icon) {
        case 'clothes-icon':
            $borderColor = 'hover:border-purple-300';
            $shadowColor = 'hover:shadow-[0_20px_40px_-15px_rgba(139,92,246,0.3)]';
            $iconBg = 'from-[#8B5CF6] to-[#7C3AED]';
            $textColor = 'group-hover:text-purple-600 text-purple-600';
            $svg = '<svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.57a1 1 0 00.99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.57a2 2 0 00-1.34-2.23z"/></svg>';
            $description = 'اشتريت أونلاين أو من المحل وعايز حاجتك توصلك؟ مندوبينا هيوصلوا لك لبسك وأغراضك بكل عناية.';
            $action = 'اطلب توصيل';
            break;
        case 'restaurant-icon':
            $borderColor = 'hover:border-orange-300';
            $shadowColor = 'hover:shadow-[0_20px_40px_-15px_rgba(249,115,22,0.3)]';
            $iconBg = 'from-[#F97316] to-[#EA580C]';
            $textColor = 'group-hover:text-orange-600 text-orange-600';
            $svg = '<svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>';
            $description = 'أكلك المفضل هيوصلك سخن وفي ميعاده. نغطي مجموعة واسعة من المطاعم لتلبية كل أذواقك.';
            $action = 'تصفح المطاعم';
            break;
        case 'pharmacy-icon':
            $borderColor = 'hover:border-teal-300';
            $shadowColor = 'hover:shadow-[0_20px_40px_-15px_rgba(20,184,166,0.3)]';
            $iconBg = 'from-[#14B8A6] to-[#0D9488]';
            $textColor = 'group-hover:text-teal-600 text-teal-600';
            $svg = '<svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="4"/><path d="M12 8v8M8 12h8"/></svg>';
            $description = 'في أوقات التعب إحنا معاك. نوفر لك الأدوية والمستلزمات الطبية من أقرب صيدلية في وقت قياسي جداً.';
            $action = 'اطلب أدويتك';
            break;
        case 'supermarket-icon':
            $borderColor = 'hover:border-blue-300';
            $shadowColor = 'hover:shadow-[0_20px_40px_-15px_rgba(59,130,246,0.3)]';
            $iconBg = 'from-[#3B82F6] to-[#2563EB]';
            $textColor = 'group-hover:text-blue-600 text-blue-600';
            $svg = '<svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 001.94-1.5l1.32-6.5H6"/></svg>';
            $description = 'كل احتياجات بيتك اليومية من خضار، فواكه، ومعلبات هتوصلك طازجة من أقرب سوبر ماركت ليك بدون ما تتحرك من مكانك.';
            $action = 'تسوق الآن';
            break;
        case 'custom-icon':
        default:
            $borderColor = 'hover:border-yellow-300';
            $shadowColor = 'hover:shadow-[0_20px_40px_-15px_rgba(255,193,7,0.3)]';
            $iconBg = 'from-[#FFC107] to-[#F59E0B]';
            $textColor = 'group-hover:text-yellow-600 text-yellow-600';
            $svg = '<svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>';
            $description = 'نسيت مفاتيحك؟ محتاج توصل ورق مهم؟ أو حتى هدية لصديق؟ بنوصلك أي حاجة من مكان لمكان بأمان تام وفي أسرع وقت.';
            $action = 'اطلب الآن';
            break;
    }
    
    // We only want the hover text color part for the title
    $titleHoverColor = explode(' ', $textColor)[0];
    $actionTextColor = explode(' ', $textColor)[1];
@endphp

<div onclick="window.location.href='tel:01097752649'" data-aos="fade-up" data-aos-delay="{{ $delay }}" class="group bg-white rounded-[24px] p-8 border border-gray-100 hover-lift {{ $borderColor }} {{ $shadowColor }} transition-all duration-500 cursor-pointer">
    <div class="w-16 h-16 mb-6 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-500 bg-gradient-to-br {{ $iconBg }}">
        {!! $svg !!}
    </div>
    <h3 class="text-xl font-bold text-[#0B1536] mb-3 {{ $titleHoverColor }} transition-colors">{{ $category->name }}</h3>
    <p class="text-gray-500 text-sm leading-relaxed mb-4 group-hover:text-gray-600 transition-colors">{{ $description }}</p>
    <div class="inline-flex items-center gap-2 {{ $actionTextColor }} font-bold">
        {{ $action }}
        <svg class="w-4 h-4 rotate-180 animate-bounce-x" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </div>
</div>
