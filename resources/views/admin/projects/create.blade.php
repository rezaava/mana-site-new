@extends('layouts.admin') {{-- یا layout ادمین شما --}}

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">افزودن پروژه جدید</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">عنوان پروژه</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">دسته‌بندی</label>
                        <select name="cat_id" class="form-select">
                            <option value="">انتخاب دسته‌بندی...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">توضیح کوتاه (Brief)</label>
                        <textarea name="brief" class="form-control" rows="2">{{ old('brief') }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">توضیحات کامل پروژه</label>
                        <textarea name="desc" class="form-control" rows="4">{{ old('desc') }}</textarea>
                    </div>

                    {{-- فیلدهای اضافه شده: چالش و راه‌حل --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-warning"><i class="fa-solid fa-triangle-exclamation ms-1"></i> چالش اصلی پروژه</label>
                        <textarea name="challenge" class="form-control" rows="4" placeholder="چالش‌هایی که در این پروژه وجود داشت را بنویسید...">{{ old('challenge') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-info"><i class="fa-solid fa-lightbulb ms-1"></i> راه‌حل ما</label>
                        <textarea name="solution" class="form-control" rows="4" placeholder="راه‌حل‌ها و راهکارهایی که پیاده کردید را بنویسید...">{{ old('solution') }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">تصویر اصلی پروژه</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-success px-4">ذخیره پروژه</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary me-2">انصراف</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection