<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ورود به حساب کاربری</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    {{-- Font Awesome برای آیکون‌ها --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div class="box">
        <div class="login">
            <div class="loginBx">

                <h2 style="padding-bottom: 4rem; font-size: 30px;">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    ورود
                </h2>

                <input type="text" id="loginIdentifier" placeholder="نام کاربری یا ایمیل" autocomplete="username">
                <input type="password" id="loginPassword" placeholder="رمز عبور" autocomplete="current-password">
                <input type="submit" id="loginBtn" value="ورود" />

                <div id="loginError" style="display:none; margin-top:15px; padding:10px 14px; border-radius:8px;
                            background: rgba(239,68,68,0.1); border:1px solid #ef4444;
                            color:#ef4444; font-size:13px; text-align:center;">
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const identifierInput = document.getElementById('loginIdentifier');
            const passwordInput = document.getElementById('loginPassword');
            const loginBtn = document.getElementById('loginBtn');
            const errorBox = document.getElementById('loginError');

            // نمایش پیام خطا
            function showError(message) {
                errorBox.textContent = message;
                errorBox.style.display = 'block';
            }

            function hideError() {
                errorBox.style.display = 'none';
                errorBox.textContent = '';
            }

            // تابع ورود
            async function doLogin() {
                hideError();

                const identifier = identifierInput.value.trim();
                const password = passwordInput.value;

                // اعتبارسنجی اولیه
                if (!identifier) {
                    showError('لطفاً نام کاربری یا ایمیل را وارد کنید.');
                    identifierInput.focus();
                    return;
                }

                if (!password) {
                    showError('لطفاً رمز عبور را وارد کنید.');
                    passwordInput.focus();
                    return;
                }

                // غیرفعال کردن دکمه
                const originalValue = loginBtn.value;
                loginBtn.disabled = true;
                loginBtn.value = 'در حال ورود...';

                try {
                    const response = await fetch('{{ route('login') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            email: identifier,   // یا email بسته به بک‌اند
                            password: password
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        // خطاهای اعتبارسنجی Laravel
                        if (data.errors) {
                            const firstError = Object.values(data.errors)[0];
                            showError(Array.isArray(firstError) ? firstError[0] : firstError);
                        } else {
                            showError(data.message || 'نام کاربری یا رمز عبور اشتباه است.');
                        }

                        loginBtn.disabled = false;
                        loginBtn.value = originalValue;
                        return;
                    }

                    // ورود موفق
                    loginBtn.value = 'ورود موفق...';

                    // هدایت به داشبورد
                    window.location.href = data.redirect || '{{ url('/admin/2') }}';

                } catch (err) {
                    console.error('Login error:', err);
                    showError('خطا در ارتباط با سرور. لطفاً دوباره تلاش کنید.');

                    loginBtn.disabled = false;
                    loginBtn.value = originalValue;
                }
            }

            // کلیک روی دکمه ورود
            loginBtn.addEventListener('click', doLogin);

            // فشردن Enter در فیلدها
            identifierInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    doLogin();
                }
            });

            passwordInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    doLogin();
                }
            });

        });
    </script>
</body>

</html>