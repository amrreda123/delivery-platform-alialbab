@extends('layouts.admin')

@section('title', 'إعدادات النظام')
@section('page-title', 'إعدادات النظام')
@section('page-subtitle', 'تحديث بيانات التواصل وطرق الدفع الظاهرة على الموقع')

@section('content')

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Main Settings Column --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Payment Numbers --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FFC107]/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-[#FFC107]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-black text-[#0B1536] text-sm">أرقام الدفع الإلكتروني</h3>
                        <p class="text-xs text-gray-400">تظهر هذه الأرقام في صفحة الرئيسية وتواصل معنا</p>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Vodafone Cash --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2 flex items-center gap-2">
                            <span class="w-5 h-5 rounded bg-red-100 flex items-center justify-center">
                                <svg class="w-3 h-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </span>
                            فودافون كاش
                        </label>
                        <input type="text" name="vodafone_cash_number"
                               value="{{ old('vodafone_cash_number', $settings['vodafone_cash_number'] ?? '') }}"
                               placeholder="01xxxxxxxxx"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-[#FFC107]/20 outline-none transition text-sm font-mono font-bold text-[#E60000] @error('vodafone_cash_number') border-red-400 @enderror"
                               dir="ltr">
                        @error('vodafone_cash_number')
                            <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Etisalat Cash --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2 flex items-center gap-2">
                            <span class="w-5 h-5 rounded bg-green-100 flex items-center justify-center">
                                <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </span>
                            اتصالات كاش
                        </label>
                        <input type="text" name="etisalat_cash_number"
                               value="{{ old('etisalat_cash_number', $settings['etisalat_cash_number'] ?? '') }}"
                               placeholder="01xxxxxxxxx"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-[#FFC107]/20 outline-none transition text-sm font-mono font-bold text-[#73C044] @error('etisalat_cash_number') border-red-400 @enderror"
                               dir="ltr">
                        @error('etisalat_cash_number')
                            <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Social Media Links --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-black text-[#0B1536] text-sm">روابط التواصل الاجتماعي</h3>
                        <p class="text-xs text-gray-400">تظهر هذه الروابط في صفحة تواصل معنا</p>
                    </div>
                </div>
                <div class="p-6 space-y-4">

                    @php
                        $socialFields = [
                            'whatsapp_link'  => ['label' => 'واتساب',   'color' => '#25D366', 'bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'placeholder' => 'https://wa.me/201xxxxxxxxx'],
                            'facebook_link'  => ['label' => 'فيسبوك',   'color' => '#1877F2', 'bg' => 'bg-blue-50',    'text' => 'text-blue-600',    'placeholder' => 'https://facebook.com/...'],
                            'instagram_link' => ['label' => 'انستجرام', 'color' => '#E1306C', 'bg' => 'bg-pink-50',    'text' => 'text-pink-600',    'placeholder' => 'https://instagram.com/...'],
                            'youtube_link'   => ['label' => 'يوتيوب',   'color' => '#FF0000', 'bg' => 'bg-red-50',     'text' => 'text-red-600',     'placeholder' => 'https://youtube.com/@...'],
                            'tiktok_link'    => ['label' => 'تيك توك',  'color' => '#000000', 'bg' => 'bg-gray-100',   'text' => 'text-gray-700',    'placeholder' => 'https://tiktok.com/@...'],
                        ];
                    @endphp

                    @foreach($socialFields as $fieldKey => $field)
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">{{ $field['label'] }}</label>
                        <div class="flex items-center gap-2">
                            <span class="w-10 h-10 rounded-xl {{ $field['bg'] }} flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 {{ $field['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                            </span>
                            <input type="url" name="{{ $fieldKey }}"
                                   value="{{ old($fieldKey, $settings[$fieldKey] ?? '') }}"
                                   placeholder="{{ $field['placeholder'] }}"
                                   class="flex-1 px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-[#FFC107]/20 outline-none transition text-sm @error($fieldKey) border-red-400 @enderror"
                                   dir="ltr">
                        </div>
                        @error($fieldKey)
                            <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    @endforeach

                </div>
            </div>

        </div>

        {{-- Sidebar: Save & Info --}}
        <div class="lg:col-span-1 space-y-5">

            {{-- Save Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <h3 class="font-black text-[#0B1536] mb-1">حفظ التغييرات</h3>
                <p class="text-xs text-gray-400 mb-5">ستظهر التعديلات على الموقع فور حفظها</p>

                <button type="submit"
                        class="w-full bg-[#0B1536] text-white py-3.5 px-6 rounded-xl font-bold text-sm hover:bg-[#1a2a5e] transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    حفظ الإعدادات
                </button>

                <a href="{{ route('admin.dashboard') }}"
                   class="mt-3 w-full flex items-center justify-center gap-2 py-3 px-6 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50 transition text-sm font-semibold">
                    إلغاء
                </a>
            </div>

            {{-- Info Box --}}
            <div class="bg-[#FFC107]/5 border border-[#FFC107]/20 rounded-2xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-[#FFC107]/20 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-[#B45309]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-[#B45309] mb-1">ملاحظة مهمة</p>
                        <p class="text-xs text-[#92400E] leading-relaxed">تأكد من صحة الأرقام والروابط قبل الحفظ، لأنها ستظهر مباشرةً للعملاء على الموقع.</p>
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">معاينة سريعة</p>
                <div class="space-y-2">
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-sm text-gray-600 hover:text-[#FFC107] transition font-medium py-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        الصفحة الرئيسية
                    </a>
                    <a href="{{ route('contact') }}" target="_blank" class="flex items-center gap-2 text-sm text-gray-600 hover:text-[#FFC107] transition font-medium py-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        صفحة تواصل معنا
                    </a>
                </div>
            </div>

        </div>

    </div>
</form>

@endsection
