@extends('layouts.app')

@section('content')

<!-- Hero Section for Tracking -->
<div class="bg-[#0B1536] py-16 text-center text-white relative">
    <!-- Back Button -->
    <div class="absolute top-6 right-6">
        <a href="{{ route('profile') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            رجوع للطلبات
        </a>
    </div>

    <h1 class="text-4xl font-black mb-4">إعدادات الحساب ⚙️</h1>
    <p class="text-gray-300 max-w-lg mx-auto">يمكنك تعديل بياناتك الشخصية وتغيير كلمة المرور من هنا.</p>
</div>

<div class="max-w-xl mx-auto px-6 py-12">
    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
        <form action="{{ route('profile.settings.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name Input -->
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">الاسم الكامل</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-[#FFC107]/20 outline-none transition text-sm font-bold @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Input (Readonly) -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني <span class="text-xs text-gray-400 font-normal">(لا يمكن تغييره)</span></label>
                <input type="email" id="email" value="{{ $user->email }}" readonly disabled
                       class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 text-gray-500 outline-none text-sm font-bold cursor-not-allowed">
            </div>

            <!-- Phone Input (Readonly) -->
            <div>
                <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">رقم الموبايل <span class="text-xs text-gray-400 font-normal">(لا يمكن تغييره)</span></label>
                <input type="text" id="phone" value="{{ $user->phone }}" readonly disabled
                       class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 text-gray-500 outline-none text-sm font-bold cursor-not-allowed">
            </div>

            <hr class="border-gray-100 my-6">

            <div class="mb-4">
                <h3 class="text-lg font-black text-[#0B1536]">تغيير كلمة المرور</h3>
                <p class="text-xs text-gray-500 font-medium">اترك الحقول فارغة إذا كنت لا تريد تغيير كلمة المرور.</p>
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور الجديدة</label>
                <input type="password" id="password" name="password"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-[#FFC107]/20 outline-none transition text-sm font-bold @error('password') border-red-500 @enderror"
                       placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">تأكيد كلمة المرور</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-[#FFC107]/20 outline-none transition text-sm font-bold"
                       placeholder="••••••••">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-[#0B1536] hover:bg-gray-900 text-white font-bold py-4 rounded-xl transition shadow-lg flex justify-center items-center gap-2">
                حفظ التعديلات
            </button>
        </form>
    </div>
</div>

@endsection
