@extends('admin.panel')

@section('content')
    <style>
        /* ===== استایل فرم افزودن سوال متداول ===== */
        .faq-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .faq-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .faq-form-title {
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
            grid-template-columns: 120px 1fr;
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

        .form-error {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 4px;
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

        /* ===== ریسپانسیو ===== */
        @media (max-width: 768px) {
            .faq-form-card {
                padding: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="faq-form-card">
            <div class="faq-form-header">
                <h5 class="faq-form-title">
                    <i class="fa-solid fa-plus"></i> افزودن سوال متداول جدید
                </h5>
                <a href="{{ route('questions.index') }}" class="btn-back-form">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت
                </a>
            </div>

            @if (session('success'))
                <div class="form-error" style="color:#10b981; margin-bottom: 15px;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="form-error" style="color:#ef4444; margin-bottom: 15px;">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('questions.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">شماره ترتیب</label>
                        <input type="number" name="number" value="{{ old('number', 1) }}" required min="1"
                            class="form-input">
                        @error('number')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">صورت سوال</label>
                        <input type="text" name="question" value="{{ old('question') }}" required
                            placeholder="مثلا: نحوه ثبت‌نام به چه صورت است؟" class="form-input">
                        @error('question')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">پاسخ سوال</label>
                    <textarea name="answer" rows="5" required placeholder="پاسخ کامل سوال را بنویسید..."
                        class="form-textarea" style="resize: vertical;">{{ old('answer') }}</textarea>
                    @error('answer')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-submit-form">
                    <i class="fa-solid fa-check"></i> ذخیره سوال
                </button>
            </form>
        </div>
    </div>
@endsection