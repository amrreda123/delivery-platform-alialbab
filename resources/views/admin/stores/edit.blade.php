@extends('layouts.admin')

@section('title', 'تعديل متجر')
@section('page-title', 'تعديل بيانات المتجر')
@section('page-subtitle', 'تعديل بيانات متجر: ' . $store->name)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm">
        <form action="{{ route('admin.stores.update', $store) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">اسم المتجر <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $store->name) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-yellow-100 transition-all outline-none bg-gray-50 focus:bg-white text-sm font-semibold" placeholder="أدخل اسم المتجر">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">القسم <span class="text-red-500">*</span></label>
                    <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-yellow-100 transition-all outline-none bg-gray-50 focus:bg-white text-sm font-semibold">
                        <option value="">اختر القسم...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $store->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#0B1536] mb-2">شعار المتجر</label>
                    @if($store->logo)
                        <div class="mb-3 w-16 h-16 rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset('storage/' . $store->logo) }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="logo" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-yellow-100 transition-all outline-none bg-gray-50 focus:bg-white text-sm font-semibold">
                    <p class="text-gray-400 text-xs mt-1">اترك هذا الحقل فارغاً إذا كنت لا تود تغيير الشعار الحالي.</p>
                    @error('logo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="pt-2">
                    <label class="flex items-center gap-3 cursor-pointer w-max">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $store->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#FFC107] focus:ring-[#FFC107] transition-all">
                        <span class="text-sm font-bold text-[#0B1536]">تفعيل المتجر</span>
                    </label>
                </div>
            </div>

            <div class="pt-6 mt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.stores.index') }}" class="px-6 py-2.5 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-colors text-sm">إلغاء</a>
                <button type="submit" class="bg-[#FFC107] hover:bg-yellow-400 text-[#0B1536] px-8 py-2.5 rounded-xl font-black text-sm transition-all shadow-lg shadow-yellow-500/30">تحديث المتجر</button>
            </div>
        </form>
    </div>
</div>
@endsection
