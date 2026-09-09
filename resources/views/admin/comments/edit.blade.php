@extends('admin.panel')

@section('content')
    <style>
        /* ===== استایل فرم ویرایش نظر ===== */
        .comment-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .comment-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .comment-form-title {
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

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--accent-2);
        }

        .checkbox-group label {
            cursor: pointer;
            user-select: none;
            color: var(--text-dim);
            font-weight: 500;
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
            .comment-form-card {
                padding: 15px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="comment-form-card">
            <div class="comment-form-header">
                <h5 class="comment-form-title">
                    <i class="fa-solid fa-pen-to-square"></i> ویرایش نظر
                </h5>
                <a href="{{ route('comments.index') }}" class="btn-back-form">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت
                </a>
            </div>

            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">نام کاربر</label>
                    <input type="text" name="user_name" value="{{ old('user_name', $comment->user_name) }}" required
                        class="form-input" placeholder="نام کاربر">
                    @error('user_name')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">متن نظر</label>
                    <textarea name="content" rows="6" required class="form-textarea"
                        placeholder="متن نظر...">{{ old('content', $comment->content) }}</textarea>
                    @error('content')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="is_approved" id="is_approved" value="1" {{ $comment->is_approved ? 'checked' : '' }}>
                    <label for="is_approved">تایید شده باشد</label>
                </div>

                <button type="submit" class="btn-submit-form">
                    <i class="fa-solid fa-save"></i> بروزرسانی نظر
                </button>
            </form>
        </div>
    </div>
@endsection