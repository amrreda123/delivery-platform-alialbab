@extends('layouts.app')

@section('content')
<div class="bg-gray-50 flex items-center justify-center min-h-[calc(100vh-80px)] py-12">
    <div class="w-full max-w-md bg-white rounded-[32px] shadow-2xl p-10 border border-gray-100 relative overflow-hidden mx-4">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#FFC107] rounded-full mix-blend-multiply filter blur-[64px] opacity-20 -z-10"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-500 rounded-full mix-blend-multiply filter blur-[64px] opacity-10 -z-10"></div>

        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-[#0B1536] mb-2">تسجيل الدخول</h1>
            <p class="text-gray-500 text-sm">أهلاً بك مرة أخرى في علي الباب 👋</p>
        </div>

        <form action="{{ route('customer.login.post') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني</label>
                <div class="relative">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-[#FFC107]/20 outline-none transition text-sm font-bold @error('email') border-red-500 @enderror"
                           placeholder="example@email.com">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required
                           class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-[#FFC107]/20 outline-none transition text-sm font-bold @error('password') border-red-500 @enderror"
                           placeholder="••••••••">
                    <button type="button" onclick="togglePassword('password')" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-[#0B1536] border-gray-300 rounded focus:ring-[#0B1536]">
                <label for="remember" class="mr-2 block text-sm text-gray-600 font-medium">تذكرني</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3.5 px-6 bg-[#0B1536] text-white rounded-xl font-bold hover:bg-[#1a2a5e] transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                دخول
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-gray-500">
            ليس لديك حساب؟ 
            <a href="{{ route('customer.register') }}" class="font-bold text-[#FFC107] hover:text-[#e0a800]">أنشئ حساباً جديداً</a>
        </p>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>
@endsection
