@extends('admin.panel')

@section('content')
    <style>
        /* ===== استایل فرم متن‌های سایت ===== */
        .site-texts-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .site-texts-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .site-texts-title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
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

        .alert-success-site-texts {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .site-texts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .site-text-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .site-text-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--accent);
        }

        .site-text-input {
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

        .site-text-input:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 20%, transparent);
            background: var(--card-hover);
        }

        .site-text-input::placeholder {
            color: var(--text-dimmer);
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
            .site-texts-card {
                padding: 15px;
            }

            .site-texts-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="site-texts-card">
            <div class="site-texts-header">
                <h5 class="site-texts-title">
                    <i class="fa-solid fa-text-height"></i> مدیریت متن‌های سایت
                </h5>
                <a href="{{ url('/admin/2') }}" class="btn-back-form">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت به داشبورد
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success-site-texts">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('site-texts.update') }}" method="POST">
                @csrf

                <div class="site-texts-grid">
                    @foreach($texts as $key => $item)
                        <div class="site-text-field">
                            <label class="site-text-label">{{ $item['label'] }}</label>
                            <input type="text" name="{{ $key }}" value="{{ old($key, $item['value']) }}"
                                class="site-text-input">
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn-submit-form">
                    <i class="fa-solid fa-save"></i> ذخیره همه
                </button>
            </form>
        </div>
    </div>
@endsection