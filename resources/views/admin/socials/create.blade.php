@extends('admin.panel')

@section('content')

    <style>
        .social-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .social-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .social-form-title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text);
        }

        .btn-back-form {
            color: var(--text-dim);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .btn-back-form:hover {
            color: var(--text);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dim);
        }

        .form-input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: transparent;
            color: var(--text);
            transition: all 0.3s var(--ease);
            font-family: inherit;
            font-size: 0.9rem;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 20%, transparent);
            background: var(--card-hover);
        }

        .form-input::placeholder {
            color: var(--text-dimmer);
        }

        .form-error {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        .icon-preview {
            width: 55px;
            height: 55px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface-2);
            color: var(--text);
            font-size: 26px;
            margin-top: 5px;
        }

        .btn-submit-form {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--brand), var(--accent-2));
            color: var(--oncta);
            transition: all 0.3s var(--ease);
            text-decoration: none;
            font-family: inherit;
            font-size: 0.9rem;
        }

        .btn-submit-form:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {

            .social-form-card {
                padding: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

        }
    </style>

    <div style="padding: 20px;">

        <div class="social-form-card">

            <div class="social-form-header">

                <h5 class="social-form-title">
                    <i class="fa-solid fa-plus"></i>
                    افزودن شبکه اجتماعی جدید
                </h5>

                <a
                    href="{{ route('socials.index') }}"
                    class="btn-back-form"
                >
                    <i class="fa-solid fa-arrow-right"></i>
                    بازگشت
                </a>

            </div>

            @if (session('success'))
                <div class="form-error" style="color:#10b981; margin-bottom:15px;">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="form-error" style="color:#ef4444; margin-bottom:15px;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form
                action="{{ route('socials.store') }}"
                method="POST"
            >

                @csrf

                <div class="form-grid">

                    <div class="form-group">

                        <label class="form-label">
                            نام شبکه اجتماعی
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="مثلا: تلگرام، اینستاگرام..."
                            class="form-input"
                        >

                        @error('name')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label class="form-label">
                            کلاس آیکون
                        </label>

                        <input
                            type="text"
                            name="icon_class"
                            value="{{ old('icon_class') }}"
                            required
                            placeholder="مثلا:  fa-telegram"
                            class="form-input"
                            dir="ltr"
                        >

                        @error('icon_class')
                            <small class="form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>

                <div class="form-group">

                    <label class="form-label">
                        آدرس لینک (URL)
                    </label>

                    <input
                        type="url"
                        name="url"
                        value="{{ old('url') }}"
                        required
                        placeholder="https://..."
                        class="form-input"
                        dir="ltr"
                    >

                    @error('url')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label">
                        پیش‌نمایش آیکون
                    </label>

                    <span class="icon-preview" id="iconPreview">
                        <i class="fa-solid fa-icons"></i>
                    </span>

                </div>

                <button
                    type="submit"
                    class="btn-submit-form"
                >
                    <i class="fa-solid fa-check"></i>
                    ذخیره شبکه اجتماعی
                </button>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const iconInput = document.querySelector('input[name="icon_class"]');
            const iconPreview = document.getElementById('iconPreview');

            if (!iconInput || !iconPreview) {
                return;
            }

            iconInput.addEventListener('input', function () {

                const iconName = this.value.trim();

                iconPreview.innerHTML = '';

                if (iconName) {
                    const icon = document.createElement('i');
                    icon.className = 'fa-brands ' + iconName;
                    iconPreview.appendChild(icon);
                } else {
                    const icon = document.createElement('i');
                    icon.className = 'fa-solid fa-icons';
                    iconPreview.appendChild(icon);
                }

            });

        });
    </script>

@endsection