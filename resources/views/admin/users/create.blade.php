@extends('layouts.admin')

@section('title', 'إضافة عميل جديد')
@section('page-title', 'إضافة عميل')
@section('page-subtitle', 'إضافة عميل جديد للنظام')

@section('content')
<div class="max-w-3xl">
    <div class="glass-card p-6" data-aos="fade-up">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">اسم العميل</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none"
                           placeholder="اكتب اسم العميل">
                    @error('name')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">رقم الهاتف (لتسجيل الدخول)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required dir="ltr"
                           class="w-full text-left bg-gray-50 border @error('phone') border-red-500 @else border-gray-200 @enderror text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none"
                           placeholder="مثال: 01xxxxxxxxx">
                    @error('phone')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">كلمة المرور</label>
                    <input type="password" name="password" required dir="ltr"
                           class="w-full text-left bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none">
                    @error('password')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div>
                    <label class="flex items-center gap-3 cursor-pointer p-4 rounded-xl border border-gray-200 bg-gray-50/50 hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-5 h-5 text-[#FFC107] bg-white border-gray-300 rounded focus:ring-[#FFC107] focus:ring-2">
                        <div>
                            <span class="block text-sm font-bold text-[#0B1536]">حساب نشط</span>
                            <span class="block text-xs text-gray-500 mt-0.5">يمكنه تسجيل الدخول للنظام وإجراء الطلبات</span>
                        </div>
                    </label>
                </div>

            </div>

            <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                <button type="submit" class="bg-[#0B1536] text-white font-bold px-8 py-3 rounded-xl hover:bg-blue-900 transition-colors shadow-lg shadow-blue-900/20">
                    حفظ البيانات
                </button>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-100 text-gray-700 font-bold px-8 py-3 rounded-xl hover:bg-gray-200 transition-colors">
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
