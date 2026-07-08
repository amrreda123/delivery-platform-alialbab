<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول للإدارة - علي الباب</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-[32px] shadow-2xl p-10 border border-gray-100 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#FFC107] rounded-full mix-blend-multiply filter blur-[64px] opacity-20 -z-10"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-500 rounded-full mix-blend-multiply filter blur-[64px] opacity-10 -z-10"></div>

        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-[#0B1536] mb-2">تسجيل الدخول</h1>
            <p class="text-gray-500 text-sm">أهلاً بك في لوحة تحكم "علي الباب"</p>
        </div>

        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email Input -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني</label>
                <div class="relative">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full pl-4 pr-11 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-[#FFC107]/20 outline-none transition text-sm font-bold @error('email') border-red-500 @enderror"
                        placeholder="admin@example.com">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور</label>
                <div class="relative">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input type="password" id="password" name="password" required
                           class="w-full pl-4 pr-11 py-3 rounded-xl border border-gray-200 focus:border-[#FFC107] focus:ring-2 focus:ring-[#FFC107]/20 outline-none transition text-sm font-bold @error('password') border-red-500 @enderror"
                           placeholder="••••••••">
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
                دخول للإدارة
            </button>
        </form>
    </div>

</body>
</html>
