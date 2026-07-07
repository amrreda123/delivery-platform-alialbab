@extends('layouts.admin')

@section('title', 'تعديل بيانات المندوب')
@section('page-title', 'تعديل بيانات المندوب')
@section('page-subtitle', 'تحديث بيانات ' . $driver->name)

@section('content')
<div class="max-w-3xl">
    <div class="glass-card p-6" data-aos="fade-up">
        <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">اسم المندوب</label>
                    <input type="text" name="name" value="{{ old('name', $driver->name) }}" required
                           class="w-full bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none">
                    @error('name')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">رقم الهاتف (لتسجيل الدخول)</label>
                    <input type="text" name="phone" value="{{ old('phone', $driver->phone) }}" required dir="ltr"
                           class="w-full text-left bg-gray-50 border @error('phone') border-red-500 @else border-gray-200 @enderror text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none">
                    @error('phone')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">كلمة المرور (اتركها فارغة إذا لم ترد التغيير)</label>
                    <input type="password" name="password" dir="ltr"
                           class="w-full text-left bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none">
                    @error('password')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div>
                    <label class="flex items-center gap-3 cursor-pointer p-4 rounded-xl border border-gray-200 bg-gray-50/50 hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $driver->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 text-[#FFC107] bg-white border-gray-300 rounded focus:ring-[#FFC107] focus:ring-2">
                        <div>
                            <span class="block text-sm font-bold text-[#0B1536]">مندوب نشط</span>
                            <span class="block text-xs text-gray-500 mt-0.5">يمكنه استقبال الطلبات وتسجيل الدخول للنظام</span>
                        </div>
                    </label>
                </div>

            </div>

            <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                <button type="submit" class="bg-[#0B1536] text-white font-bold px-8 py-3 rounded-xl hover:bg-blue-900 transition-colors shadow-lg shadow-blue-900/20">
                    حفظ التعديلات
                </button>
                <a href="{{ route('admin.drivers.index') }}" class="bg-gray-100 text-gray-700 font-bold px-8 py-3 rounded-xl hover:bg-gray-200 transition-colors">
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
