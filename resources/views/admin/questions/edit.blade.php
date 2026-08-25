@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    {{-- Alerts Section --}}
    @if (session('success'))
        <div style="background: #10b981; color: #fff; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background: #ef4444; color: #fff; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px;">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-pen-to-square"></i> ویرایش سوال متداول
            </h5>
            <a href="{{ route('questions.index') }}" style="color: var(--text-light); text-decoration: none;">
                <i class="fa-solid fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <form action="{{ route('questions.update', $question->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 120px 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 8px;">شماره ترتیب</label>
                    <input type="number" name="number" value="{{ old('number', $question->number) }}" required min="1" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('number')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">صورت سوال</label>
                    <input type="text" name="title" value="{{ old('question', $question->title) }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('question')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">پاسخ سوال</label>
                <textarea name="answer" rows="5" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit; resize: vertical;">{{ old('answer', $question->answer) }}</textarea>
                @error('answer')
                    <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                <i class="fa-solid fa-check"></i> بروزرسانی سوال
            </button>
        </form>
    </div>
</div>
@endsection