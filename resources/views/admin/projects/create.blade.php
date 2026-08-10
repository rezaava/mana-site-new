@extends('admin.panel')
@section('content')
<div style="padding:20px;"><div style="background:var(--card-bg);border-radius:12px;padding:20px;">
<h5 style="margin-bottom:20px;"><i class="fa-solid fa-plus-circle"></i> افزودن پروژه</h5>
<form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div style="margin-bottom:15px;"><label>عنوان</label><input type="text" name="title" required style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;"></div>
<div style="margin-bottom:15px;"><label>توضیح کوتاه</label><textarea name="brief" rows="2" style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;"></textarea></div>
<div style="margin-bottom:15px;"><label>توضیحات کامل</label><textarea name="desc" rows="4" style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;"></textarea></div>
<div style="margin-bottom:15px;"><label>تصویر</label><input type="file" name="image" style="width:100%;padding:10px;"></div>
<div style="margin-bottom:15px;"><label>دسته‌بندی (cat-id)</label><input type="number" name="cat-id" style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;"></div>
<button type="submit" class="btn btn-primary">ذخیره</button>
<a href="{{ route('projects.index') }}" class="btn btn-secondary">بازگشت</a>
</form>
</div></div>
@endsection
