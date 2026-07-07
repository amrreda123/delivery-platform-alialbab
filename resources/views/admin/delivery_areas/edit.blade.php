@extends('layouts.admin')

@section('title', 'تعديل منطقة توصيل')
@section('page-title', 'تعديل بيانات المنطقة')
@section('page-subtitle', 'تعديل بيانات منطقة: ' . $deliveryArea->name)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm">
        <form action="{{ route('admin.delivery-areas.update', $deliveryArea) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">اسم المنطقة <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $deliveryArea->name) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-yellow-100 transition-all outline-none bg-gray-50 focus:bg-white text-sm font-semibold" placeholder="أدخل اسم المنطقة">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="pt-2">
                    <label class="flex items-center gap-3 cursor-pointer w-max">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $deliveryArea->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#FFC107] focus:ring-[#FFC107] transition-all">
                        <span class="text-sm font-bold text-[#0B1536]">تفعيل المنطقة</span>
                    </label>
                </div>
            </div>

            <div class="pt-6 mt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.delivery-areas.index') }}" class="px-6 py-2.5 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors text-sm">إلغاء</a>
                <button type="submit" class="bg-[#FFC107] hover:bg-yellow-400 text-[#0B1536] px-8 py-2.5 rounded-xl font-black text-sm transition-all shadow-lg shadow-yellow-500/30">تحديث المنطقة</button>
            </div>
        </form>
    </div>
</div>
@endsection
