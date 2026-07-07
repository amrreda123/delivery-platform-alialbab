@extends('layouts.admin')

@section('title', 'إضافة قسم جديد')
@section('page-title', 'إضافة قسم')
@section('page-subtitle', 'إضافة قسم جديد إلى المنصة')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">اسم القسم <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-yellow-100 transition-all outline-none bg-gray-50 focus:bg-white text-sm font-semibold" placeholder="أدخل اسم القسم">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">أيقونة القسم</label>
                    <input type="file" name="icon" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-yellow-100 transition-all outline-none bg-gray-50 focus:bg-white text-sm font-semibold">
                    @error('icon')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="pt-2">
                    <label class="flex items-center gap-3 cursor-pointer w-max">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#FFC107] focus:ring-[#FFC107] transition-all">
                        <span class="text-sm font-bold text-[#0B1536]">تفعيل القسم</span>
                    </label>
                </div>
            </div>

            <div class="pt-6 mt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors text-sm">إلغاء</a>
                <button type="submit" class="bg-[#0B1536] hover:bg-[#111f4d] text-white px-8 py-2.5 rounded-xl font-black text-sm transition-all shadow-lg shadow-indigo-900/20">حفظ القسم</button>
            </div>
        </form>
    </div>
</div>
@endsection
