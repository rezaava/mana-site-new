@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-user-plus"></i> افزودن کاربر جدید
            </h5>
            <a href="{{ route('users.index') }}" style="color: var(--text-light); text-decoration: none;">
                <i class="fa-solid fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 8px;">نام و نام خانوادگی</label>
                    <input type="text" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('name')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">ایمیل</label>
                    <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('email')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">رمز عبور</label>
                    <input type="password" name="password" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('password')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">نقش</label>
                    <select name="role" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>دانشجو</option>
                        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>استاد</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>ادمین</option>
                    </select>
                    @error('role')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                <i class="fa-solid fa-check"></i> ذخیره کاربر
            </button>
        </form>
    </div>
</div>
@endsection
