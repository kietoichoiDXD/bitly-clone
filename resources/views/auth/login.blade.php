<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập - ShortLink</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <div class="flex min-h-screen">
        
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 md:px-24 py-12">
            <div class="mb-8">
                <a href="/" class="flex items-center gap-2 mb-6">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                    <span class="font-bold text-2xl text-gray-900">ShortLink</span>
                </a>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Chào mừng trở lại!</h1>
                <p class="text-gray-500">Vui lòng nhập thông tin để truy cập dashboard.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                    <input id="password" type="password" name="password" required 
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">Ghi nhớ đăng nhập</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('password.request') }}">
                            Quên mật khẩu?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 shadow-lg transition transform active:scale-95">
                    Đăng nhập
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-600">
                Chưa có tài khoản? 
                <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-800">Đăng ký ngay</a>
            </div>
        </div>

        <div class="hidden lg:flex w-1/2 bg-indigo-50 items-center justify-center relative overflow-hidden">
            <div class="absolute w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob top-0 left-0"></div>
            <div class="absolute w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 bottom-0 right-0"></div>
            
            <div class="relative z-10 text-center px-12">
                <img src="https://illustrations.popsy.co/amber/working-vacation.svg" alt="Illustration" class="w-3/4 mx-auto mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Quản lý link đơn giản</h2>
                <p class="text-gray-600">Theo dõi thống kê click, quản lý chiến dịch marketing của bạn chỉ trong một nốt nhạc.</p>
            </div>
        </div>
    </div>
</body>
</html>