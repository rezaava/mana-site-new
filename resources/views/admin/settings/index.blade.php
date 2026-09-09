@extends('admin.panel')

@section('content')
    <style>
        .settings-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .settings-form-header {
            margin-bottom: 25px;
        }

        .settings-form-title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title {
            margin: 35px 0 15px;
            color: var(--accent);
            font-size: 1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--line);
        }

        .form-section-title i {
            font-size: 1.1rem;
        }

        .form-grid {
            display: grid;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-grid-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .form-grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dim);
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: transparent;
            color: var(--text);
            transition: all 0.3s var(--ease);
            font-family: inherit;
            font-size: 0.9rem;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 20%, transparent);
            background: var(--card-hover);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: var(--text-dimmer);
        }

        .btn-submit-form {
            padding: 12px 25px;
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
            font-size: 0.95rem;
        }

        .btn-submit-form:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        .alert-success-settings {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        /* ریسپانسیو */
        @media (max-width: 768px) {
            .settings-form-card {
                padding: 15px;
            }

            .form-grid-2,
            .form-grid-3 {
                grid-template-columns: 1fr;
            }

            .form-grid-2 .form-group[style*="grid-column: span 2"],
            .form-grid-3 .form-group[style*="grid-column: span 2"] {
                grid-column: span 1 !important;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="settings-form-card">
            <div class="settings-form-header">
                <h5 class="settings-form-title">
                    <i class="fa-solid fa-gear"></i> تنظیمات سایت
                </h5>
            </div>

            @if(session('success'))
                <div class="alert-success-settings">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('settings.update') }}" method="POST">
                @csrf

                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">نام سایت</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required
                            class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">ایمیل تماس</label>
                        <input type="email" name="contact_email"
                            value="{{ old('contact_email', $settings['contact_email']) }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">تلفن تماس</label>
                        <input type="text" name="contact_phone"
                            value="{{ old('contact_phone', $settings['contact_phone']) }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">آدرس</label>
                        <input type="text" name="address" value="{{ old('address', $settings['address']) }}"
                            class="form-input">
                    </div>

                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">توضیحات سایت</label>
                        <textarea name="site_description" rows="3"
                            class="form-textarea">{{ old('site_description', $settings['site_description']) }}</textarea>
                    </div>

                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">کلمات کلیدی</label>
                        <input type="text" name="site_keywords"
                            value="{{ old('site_keywords', $settings['site_keywords']) }}" class="form-input">
                    </div>
                </div>

                <h6 class="form-section-title">
                    <i class="fa-solid fa-link"></i> شبکه‌های اجتماعی
                </h6>

                <div class="form-grid form-grid-3">
                    <div class="form-group">
                        <label class="form-label">تلگرام</label>
                        <input type="url" name="telegram" value="{{ old('telegram', $settings['telegram']) }}"
                            placeholder="https://t.me/..." class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">اینستاگرام</label>
                        <input type="url" name="instagram" value="{{ old('instagram', $settings['instagram']) }}"
                            placeholder="https://instagram.com/..." class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">توییتر</label>
                        <input type="url" name="twitter" value="{{ old('twitter', $settings['twitter']) }}"
                            placeholder="https://twitter.com/..." class="form-input">
                    </div>
                </div>

                <button type="submit" class="btn-submit-form">
                    <i class="fa-solid fa-save"></i> ذخیره تنظیمات
                </button>
            </form>
        </div>
    </div>
@endsection