@extends('admin.panel')

@section('content')
<div style="padding:20px;">
    <div style="background:var(--card-bg);border-radius:12px;padding:20px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h5 style="margin:0;"><i class="fa-solid fa-tags"></i> دسته‌بندی‌ها</h5>
            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary" style="padding:8px 16px;border-radius:8px;text-decoration:none;">
                <i class="fa-solid fa-plus"></i> افزودن دسته‌بندی
            </a>
        </div>

        @if(session('success'))
            <div style="background:rgba(16,185,129,0.1);border:1px solid #10b981;color:#10b981;padding:12px;border-radius:8px;margin-bottom:20px;">{{ session('success') }}</div>
        @endif

        <table style="width:100%;border-collapse:collapse;">
            <thead><tr style="border-bottom:1px solid var(--border);">
                <th style="padding:12px;">#</th><th style="padding:12px;">نام</th><th style="padding:12px;">عملیات</th>
            </tr></thead>
            <tbody>
                @forelse($categories as $i => $category)
                    <tr style="border-bottom:1px solid var(--border);">
                        <td style="padding:12px;">{{ $categories->firstItem() + $i }}</td>
                        <td style="padding:12px;">{{ $category->name ?? $category->title }}</td>
                        <td style="padding:12px;">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning" style="padding:6px 10px;border-radius:6px;text-decoration:none;"><i class="fa-solid fa-edit"></i></a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('حذف شود؟')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" style="padding:6px 10px;border-radius:6px;border:none;"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" style="text-align:center;padding:40px;">دسته‌بندی‌ای نیست</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
