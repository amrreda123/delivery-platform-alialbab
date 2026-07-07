@extends('layouts.admin')

@section('title', 'تعديل بيانات العميل')
@section('page-title', 'تعديل بيانات العميل')
@section('page-subtitle', 'تحديث بيانات ' . $user->name)

@section('content')
<div class="max-w-3xl">
    <div class="glass-card p-6" data-aos="fade-up">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Read-only info -->
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 mb-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="block text-xs text-gray-500 mb-1">الاسم</span>
                            <span class="block text-sm font-bold text-[#0B1536]">{{ $user->name }}</span>
                        </div>
                        <div>
                            <span class="block text-xs text-gray-500 mb-1">رقم الهاتف</span>
                            <span class="block text-sm font-bold text-[#0B1536]" dir="ltr">{{ $user->phone }}</span>
                        </div>
                    </div>
                </div>

                <!-- Active Status -->
                <div>
                    <label class="flex items-center gap-3 cursor-pointer p-4 rounded-xl border border-gray-200 bg-gray-50/50 hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}
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
                    حفظ التعديلات
                </button>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-100 text-gray-700 font-bold px-8 py-3 rounded-xl hover:bg-gray-200 transition-colors">
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
