@extends('layouts.admin')

@section('title', 'إدارة الأقسام')
@section('page-title', 'الأقسام')
@section('page-subtitle', 'إدارة جميع أقسام المنصة')

@section('content')
<div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <h3 class="font-black text-[#0B1536] text-lg">قائمة الأقسام</h3>
        <a href="{{ route('admin.categories.create') }}" class="bg-[#FFC107] hover:bg-yellow-400 text-[#0B1536] px-5 py-2.5 rounded-xl font-black text-sm transition-all duration-200 shadow-lg shadow-yellow-500/30 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            إضافة قسم
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-right">
            <thead>
                <tr class="border-b border-gray-100 text-gray-400 text-sm font-bold bg-gray-50/50">
                    <th class="p-4 rounded-r-xl">الاسم</th>
                    <th class="p-4">عدد المتاجر</th>
                    <th class="p-4">الحالة</th>
                    <th class="p-4 rounded-l-xl">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 overflow-hidden border border-gray-200/50">
                                @if($category->icon)
                                    <img src="{{ asset('storage/' . $category->icon) }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                @endif
                            </div>
                            <span class="font-bold text-[#0B1536]">{{ $category->name }}</span>
                        </div>
                    </td>
                    <td class="p-4 text-gray-600 text-sm font-semibold">
                        <span class="bg-gray-100 text-gray-600 py-1 px-3 rounded-lg">{{ $category->stores_count ?? 0 }} متجر</span>
                    </td>
                    <td class="p-4">
                        @if($category->is_active)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold border border-emerald-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> نشط
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-600 text-xs font-bold border border-red-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> غير نشط
                            </span>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form id="delete-category-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-category-{{ $category->id }}', '{{ addslashes($category->name) }}')" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-400 font-semibold">
                        لا توجد أقسام مضافة حتى الآن.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
