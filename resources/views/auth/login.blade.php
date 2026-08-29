<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به حساب کاربری</title>
    
    {{-- لینک دقیق به css لاگین در پوشه public --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="box">
        <div class="login">
            <form action="{{ route('login') }}" method="POST" class="loginBx">
                @csrf

                <h2>ورود <i class="fa-solid fa-right-to-bracket"></i></h2>

                {{-- نام کاربری یا ایمیل --}}
                <input type="text" name="email" value="{{ old('email') }}" placeholder="نام کاربری یا ایمیل" required autofocus>

                {{-- رمز عبور --}}
                <input type="password" name="password" placeholder="رمز عبور" required>

                {{-- دکمه ارسال --}}
                <input type="submit" value="ورود">

                {{-- لینک‌های فراموشی رمز و ثبت‌نام --}}
                <div class="group">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">فراموشی رمز؟</a>
                    @else
                        <a href="#">فراموشی رمز؟</a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">ثبت‌نام</a>
                    @else
                        <a href="#">ثبت‌نام</a>
                    @endif
                </div>

            </form>
        </div>
    </div>

</body>
</html>