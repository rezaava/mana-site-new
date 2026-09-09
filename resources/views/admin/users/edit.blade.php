@extends('admin.panel')

@section('content')
    <style>
        /* ===== استایل فرم ویرایش کاربر ===== */
        .user-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .user-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .user-form-title {
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
        .form-select {
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
        .form-select:focus {
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
            .user-form-card {
                padding: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="user-form-card">
            <div class="user-form-header">
                <h5 class="user-form-title">
                    <i class="fa-solid fa-user-pen"></i> ویرایش کاربر
                </h5>
                <a href="{{ route('users.index') }}" class="btn-back-form">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت
                </a>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
               
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">نام و نام خانوادگی</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-input"
                            placeholder="نام کامل">
                        @error('name')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">ایمیل</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="form-input" placeholder="example@domain.com">
                        @error('email')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">رمز عبور جدید (اختیاری)</label>
                        <input type="password" name="password" class="form-input" placeholder="********">
                        @error('password')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">نقش</label>
                        <select name="role" required class="form-select">
                            <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>دانشجو
                            </option>
                            <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>استاد
                            </option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>ادمین</option>
                        </select>
                        @error('role')
                            <small class="form-error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-submit-form">
                    <i class="fa-solid fa-save"></i> بروزرسانی کاربر
                </button>
            </form>
        </div>
    </div>
@endsection