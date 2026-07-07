@extends('layouts.admin')

@section('title', 'إدارة العملاء')
@section('page-title', 'العملاء')
@section('page-subtitle', 'عرض وإدارة بيانات العملاء')

@section('content')
<div class="glass-card p-6" data-aos="fade-up">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-[#0B1536]">قائمة العملاء</h2>
        <a href="{{ route('admin.users.create') }}" class="bg-[#FFC107] text-[#0B1536] font-bold px-4 py-2 rounded-xl flex items-center gap-2 hover:bg-[#F59E0B] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            إضافة عميل
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-right whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">الاسم</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">رقم الهاتف</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">تاريخ الانضمام</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm">الحالة</th>
                    <th class="px-4 py-3 font-semibold text-gray-500 text-sm text-center">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-4 py-3">
                        <div class="font-bold text-[#0B1536]">{{ $user->name }}</div>
                    </td>
                    <td class="px-4 py-3 text-gray-600" dir="ltr">
                        {{ $user->phone }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-500" dir="ltr">
                        {{ $user->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-3">
                        @if($user->is_active)
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">نشط</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">موقوف</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="p-2 text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors" title="عرض التفاصيل وسجل الطلبات">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $user->id }}', '{{ $user->name }}')" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">لا يوجد عملاء مضافين بعد.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="mt-6">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
