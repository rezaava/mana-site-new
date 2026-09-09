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

        .form-input,
        .form-file {
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
        .form-file:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 20%, transparent);
            background: var(--card-hover);
        }

        .form-input::placeholder {
            color: var(--text-dimmer);
        }

        .form-file {
            padding: 8px;
            cursor: pointer;
        }

        .form-file::-webkit-file-upload-button {
            background: var(--brand);
            color: var(--oncta);
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            margin-left: 10px;
            transition: filter 0.2s;
        }

        .form-file::-webkit-file-upload-button:hover {
            filter: brightness(1.1);
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
                    <i class="fa-solid fa-pen-to-square"></i> ویرایش شبکه اجتماعی
                </h5>
                <a href="{{ route('socials.index') }}" class="btn-back-form">
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

            <form action="{{ route('socials.update', $social->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">نام شبکه اجتماعی</label>
                        <input type="text" name="name" value="{{ old('name', $social->name) }}" required class="form-input">
                        @error('name')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">آدرس لینک (URL)</label>
                        <input type="url" name="url" value="{{ old('url', $social->url) }}" required class="form-input">
                        @error('url')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">تصویر / آیکون جدید (اختیاری)</label>

                    @if($social->image_url)
                        <div style="margin-bottom: 10px;">
                            <span
                                style="font-size: 0.85rem; color: var(--text-dimmer); display: block; margin-bottom: 4px;">تصویر
                                فعلی:</span>
                            <img src="{{ asset('storage/' . $social->image_url) }}" alt="{{ $social->name }}"
                                style="width: 50px; height: 50px; object-fit: contain; border-radius: 8px; border: 1px solid var(--line); padding: 4px;">
                        </div>
                    @endif

                    <input type="file" name="image_url" class="form-file">
                    @error('image_url')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-submit-form">
                    <i class="fa-solid fa-check"></i> بروزرسانی شبکه اجتماعی
                </button>
            </form>
        </div>
    </div>
@endsection