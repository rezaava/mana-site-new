@extends('admin.panel')

@section('content')
    <style>
        /* ===== استایل فرم افزودن محصول ===== */
        .product-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .product-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .product-form-title {
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
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-grid-3 {
            grid-template-columns: 2fr 1fr 1fr;
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
        .form-textarea,
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
        .form-textarea:focus,
        .form-file:focus {
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

        .btn-back-form {
            padding: 10px 20px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--text-dim);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.3s var(--ease);
        }

        .btn-back-form:hover {
            background: var(--card-hover);
            color: var(--text);
        }


        /* ===== ریسپانسیو ===== */
        @media (max-width: 768px) {
            .product-form-card {
                padding: 15px;
            }

            .form-grid-3 {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="product-form-card">
            <div class="product-form-header">
                <h5 class="product-form-title">
                    <i class="fa-solid fa-plus-circle"></i> افزودن محصول جدید
                </h5>
                <a href="{{ route('sales.index') }}" class="btn-back-form">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت
                </a>
            </div>

            <form action="{{ route('sales.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-grid form-grid-3">
                    <div class="form-group">
                        <label class="form-label">عنوان محصول</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="form-input"
                            placeholder="عنوان محصول">
                        @error('title')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">قیمت (تومان)</label>
                        <input type="number" name="price" value="{{ old('price') }}" class="form-input"
                            placeholder="مثلاً 1000000">
                        @error('price')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">شماره / اولویت</label>
                        <input type="number" name="number" value="{{ old('number') }}" class="form-input"
                            placeholder="اختیاری">
                        @error('number')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label">تصویر محصول</label>
                    <input type="file" name="image" class="form-file">
                    @error('image')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">توضیحات</label>
                    <textarea name="text" rows="8" class="form-textarea"
                        placeholder="توضیحات محصول...">{{ old('text') }}</textarea>
                    @error('text')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <div style="margin-top:25px; display:flex; gap:10px; flex-wrap:wrap;">
                    <button type="submit" class="btn-submit-form">
                        <i class="fa-solid fa-check"></i> ذخیره محصول
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection