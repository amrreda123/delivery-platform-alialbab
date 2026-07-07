@extends('layouts.admin')

@section('title', 'إضافة مندوب جديد')
@section('page-title', 'إضافة مندوب')
@section('page-subtitle', 'إضافة مندوب توصيل جديد للنظام')

@section('content')
<div class="max-w-3xl">
    <div class="glass-card p-6" data-aos="fade-up">
        <form action="{{ route('admin.drivers.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <!-- Phone -->
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">رقم هاتف المستخدم (العميل)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required dir="ltr"
                           class="w-full text-left bg-gray-50 border @error('phone') border-red-500 @else border-gray-200 @enderror text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none"
                           placeholder="مثال: 01xxxxxxxxx">
                    <p class="text-xs text-gray-500 mt-1">يجب أن يكون المستخدم مسجلاً مسبقاً برقم الهاتف هذا لتحويله إلى مندوب.</p>
                    @error('phone')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex items-center gap-3 cursor-pointer p-4 rounded-xl border border-gray-200 bg-gray-50/50 hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-5 h-5 text-[#FFC107] bg-white border-gray-300 rounded focus:ring-[#FFC107] focus:ring-2">
                        <div>
                            <span class="block text-sm font-bold text-[#0B1536]">حساب نشط</span>
                            <span class="block text-xs text-gray-500 mt-0.5">يمكنه تسجيل الدخول للنظام</span>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer p-4 rounded-xl border border-gray-200 bg-gray-50/50 hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }}
                               class="w-5 h-5 text-[#FFC107] bg-white border-gray-300 rounded focus:ring-[#FFC107] focus:ring-2">
                        <div>
                            <span class="block text-sm font-bold text-[#0B1536]">متاح للعمل</span>
                            <span class="block text-xs text-gray-500 mt-0.5">جاهز لاستقبال طلبات جديدة</span>
                        </div>
                    </label>
                </div>
                
                <!-- Vehicle Type -->
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">نوع المركبة</label>
                    <select name="vehicle_type" class="w-full bg-gray-50 border @error('vehicle_type') border-red-500 @else border-gray-200 @enderror text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] focus:border-transparent transition-all outline-none">
                        <option value="motorcycle" {{ old('vehicle_type') == 'motorcycle' ? 'selected' : '' }}>موتوسيكل / دراجة نارية</option>
                        <option value="bicycle" {{ old('vehicle_type') == 'bicycle' ? 'selected' : '' }}>دراجة هوائية</option>
                        <option value="car" {{ old('vehicle_type') == 'car' ? 'selected' : '' }}>سيارة</option>
                        <option value="van" {{ old('vehicle_type') == 'van' ? 'selected' : '' }}>سيارة نقل / فان</option>
                    </select>
                    @error('vehicle_type')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                <button type="submit" class="bg-[#0B1536] text-white font-bold px-8 py-3 rounded-xl hover:bg-blue-900 transition-colors shadow-lg shadow-blue-900/20">
                    حفظ البيانات
                </button>
                <a href="{{ route('admin.drivers.index') }}" class="bg-gray-100 text-gray-700 font-bold px-8 py-3 rounded-xl hover:bg-gray-200 transition-colors">
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
