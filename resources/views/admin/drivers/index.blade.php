@extends('layouts.admin')

@section('title', 'إدارة المناديب')
@section('page-title', 'المناديب')
@section('page-subtitle', 'عرض وإدارة بيانات المناديب')

@section('content')
<div class="glass-card p-6" data-aos="fade-up">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-[#0B1536]">قائمة المناديب</h2>
        <a href="{{ route('admin.drivers.create') }}" class="bg-[#FFC107] text-[#0B1536] font-bold px-4 py-2 rounded-xl flex items-center gap-2 hover:bg-[#F59E0B] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            إضافة مندوب
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-right whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">المندوب</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">رقم الهاتف</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">تاريخ الانضمام</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">الحالة</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm text-center">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($drivers as $driver)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-4 py-3">
                        <div class="font-bold text-[#0B1536]">{{ $driver->name }}</div>
                    </td>
                    <td class="px-4 py-3 text-gray-600" dir="ltr">
                        {{ $driver->phone }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-500" dir="ltr">
                        {{ $driver->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-3">
                        @if($driver->is_active)
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">نشط</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">موقوف</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                            <form id="delete-form-{{ $driver->id }}" action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $driver->id }}', '{{ $driver->name }}')" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">لا يوجد مناديب مضافين بعد.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($drivers->hasPages())
    <div class="mt-6">
        {{ $drivers->links() }}
    </div>
    @endif
</div>
@endsection
