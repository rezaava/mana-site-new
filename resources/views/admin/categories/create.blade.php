@extends('admin.panel')
@section('content')
<div style="padding:20px;"><div style="background:var(--card-bg);border-radius:12px;padding:20px;">
<h5 style="margin-bottom:20px;"><i class="fa-solid fa-plus-circle"></i> افزودن دسته‌بندی</h5>
<form action="{{ route('categories.store') }}" method="POST">
@csrf
<div style="margin-bottom:15px;"><label style="display:block;margin-bottom:8px;">نام</label><input type="text" name="name" required style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;"></div>
<button type="submit" class="btn btn-primary">ذخیره</button>
<a href="{{ route('categories.index') }}" class="btn btn-secondary">بازگشت</a>
</form>
</div></div>
@endsection
