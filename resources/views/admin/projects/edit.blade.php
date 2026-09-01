@extends('admin.panel')

@section('content')
<div style="padding:20px;">
    <div style="background:var(--card-bg);border-radius:12px;padding:20px;">
        <h5 style="margin-bottom:20px;">
            <i class="fa-solid fa-pen-to-square"></i> ویرایش پروژه
        </h5>

        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom:15px;">
                <label style="display:block;margin-bottom:8px;">عنوان</label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" required style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;">
            </div>

            <div style="margin-bottom:15px;">
                <label style="display:block;margin-bottom:8px;">توضیح کوتاه</label>
                <textarea name="brief" rows="2" style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;">{{ old('brief', $project->brief) }}</textarea>
            </div>

            <div style="margin-bottom:15px;">
                <label style="display:block;margin-bottom:8px;">توضیحات کامل</label>
                <textarea name="desc" rows="4" style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;">{{ old('desc', $project->desc) }}</textarea>
            </div>

            {{-- چالش اصلی --}}
            <div style="margin-bottom:15px;">
                <label style="display:block;margin-bottom:8px;color:#ffc107;">
                    <i class="fa-solid fa-triangle-exclamation"></i> چالش اصلی پروژه
                </label>
                <textarea name="challenge" rows="3" placeholder="چالش‌های پروژه را بنویسید..." style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;">{{ old('challenge', $project->challenge) }}</textarea>
            </div>

            {{-- راه‌حل ما --}}
            <div style="margin-bottom:15px;">
                <label style="display:block;margin-bottom:8px;color:#0dcaf0;">
                    <i class="fa-solid fa-lightbulb"></i> راه‌حل ما
                </label>
                <textarea name="solution" rows="3" placeholder="راه‌حل‌ها و راهکارها را بنویسید..." style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;">{{ old('solution', $project->solution) }}</textarea>
            </div>

            <div style="margin-bottom:15px;">
                <label style="display:block;margin-bottom:8px;">دسته‌بندی</label>
                <select name="cat_id" style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;">
                    <option value="">انتخاب کنید</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $project->cat_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name ?? $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;">تصویر جدید</label>
                <input type="file" name="image" style="width:100%;padding:10px;">
                @if($project->image_url)
                    <div style="margin-top:10px;">
                        <img src="{{ asset('storage/' . $project->image_url) }}" style="width:70px;border-radius:8px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">بروزرسانی</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">بازگشت</a>
        </form>
    </div>
</div>
@endsection