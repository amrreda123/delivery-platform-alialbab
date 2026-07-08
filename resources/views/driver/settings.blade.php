@extends('layouts.app')

@section('content')

<div class="bg-[#0B1536] py-16 text-center text-white relative">
    <div class="absolute top-6 left-6">
        <a href="{{ route('driver.portfolio') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            العودة للبوابة
        </a>
    </div>

    <h1 class="text-4xl font-black mb-4">إعدادات حساب المندوب ⚙️</h1>
    <p class="text-gray-300 max-w-lg mx-auto">يمكنك تعديل بياناتك الشخصية وحالة التوافر للعمل من هنا.</p>
</div>

<div class="max-w-3xl mx-auto px-6 py-12">

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded-lg shadow-sm flex items-center gap-3">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-green-700 font-bold text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100">
        <form action="{{ route('driver.settings.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">الاسم بالكامل</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full bg-gray-50 border @error('name') border-red-300 @else border-gray-200 @enderror text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] outline-none font-medium transition">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone (Readonly) -->
            <div>
                <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">رقم الموبايل <span class="text-xs text-gray-400 font-normal">(لا يمكن تغييره)</span></label>
                <input type="text" id="phone" value="{{ $user->phone }}" disabled readonly dir="ltr"
                       class="w-full bg-gray-100 border border-gray-200 text-gray-500 cursor-not-allowed rounded-xl px-4 py-3 font-medium text-left">
            </div>

            <hr class="border-gray-100 my-6">

            <!-- Driver Settings -->
            <h3 class="text-lg font-bold text-[#0B1536] mb-4">بيانات التوصيل</h3>

            <!-- Vehicle Type -->
            <div>
                <label for="vehicle_type" class="block text-sm font-bold text-gray-700 mb-2">نوع المركبة</label>
                <select name="vehicle_type" id="vehicle_type" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] outline-none font-medium transition">
                    <option value="motorcycle" {{ old('vehicle_type', $user->driverProfile->vehicle_type ?? '') == 'motorcycle' ? 'selected' : '' }}>دراجة نارية (موتوسيكل)</option>
                    <option value="car" {{ old('vehicle_type', $user->driverProfile->vehicle_type ?? '') == 'car' ? 'selected' : '' }}>سيارة</option>
                    <option value="bicycle" {{ old('vehicle_type', $user->driverProfile->vehicle_type ?? '') == 'bicycle' ? 'selected' : '' }}>دراجة هوائية (عجلة)</option>
                    <option value="van" {{ old('vehicle_type', $user->driverProfile->vehicle_type ?? '') == 'van' ? 'selected' : '' }}>سيارة نقل / فان</option>
                </select>
                @error('vehicle_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Availability -->
            <div class="flex items-center gap-3 bg-gray-50 p-4 rounded-xl border border-gray-200">
                <input type="hidden" name="is_available" value="0">
                <input type="checkbox" id="is_available" name="is_available" value="1" 
                       class="w-5 h-5 text-[#FFC107] bg-white border-gray-300 rounded focus:ring-[#FFC107]"
                       {{ old('is_available', $user->driverProfile->is_available ?? false) ? 'checked' : '' }}>
                <label for="is_available" class="text-sm font-bold text-gray-800 cursor-pointer">
                    أنا متاح الآن لاستقبال طلبات جديدة 🟢
                </label>
            </div>

            <hr class="border-gray-100 my-6">

            <!-- Password -->
            <h3 class="text-lg font-bold text-[#0B1536] mb-4">تغيير كلمة المرور</h3>
            <p class="text-xs text-gray-500 mb-4">اترك الحقول فارغة إذا كنت لا ترغب في تغيير كلمة المرور.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور الجديدة</label>
                    <input type="password" id="password" name="password" dir="ltr"
                           class="w-full bg-gray-50 border @error('password') border-red-300 @else border-gray-200 @enderror text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] outline-none font-medium transition text-left">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">تأكيد كلمة المرور</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" dir="ltr"
                           class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FFC107] outline-none font-medium transition text-left">
                </div>
            </div>

            <div class="mt-8 pt-4">
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#FFC107] hover:bg-yellow-500 text-[#0B1536] font-black rounded-xl px-6 py-4 transition-all shadow-lg shadow-yellow-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
