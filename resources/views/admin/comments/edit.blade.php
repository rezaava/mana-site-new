@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-pen-to-square"></i> ویرایش نظر
            </h5>
            <a href="{{ route('comments.index') }}" style="color: var(--text-light); text-decoration: none;">
                <i class="fa-solid fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">نام کاربر</label>
                <input type="text" name="user_name" value="{{ old('user_name', $comment->user_name) }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                @error('user_name')<small style="color: #ef4444;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">متن نظر</label>
                <textarea name="content" rows="6" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">{{ old('content', $comment->content) }}</textarea>
                @error('content')<small style="color: #ef4444;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" name="is_approved" id="is_approved" value="1" {{ $comment->is_approved ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                <label for="is_approved" style="cursor: pointer; user-select: none;">تایید شده باشد</label>
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                <i class="fa-solid fa-save"></i> بروزرسانی نظر
            </button>
        </form>
    </div>
</div>
@endsection