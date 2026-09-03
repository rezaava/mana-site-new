@extends('admin.panel')

@section('content')
<div style="padding:20px;">
    <div style="background:var(--card-bg);border-radius:12px;padding:20px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h5 style="margin:0;"><i class="fa-solid fa-diagram-project"></i> مدیریت پروژه‌ها</h5>
            <a href="{{ route('projects.create') }}" class="btn btn-sm btn-primary" style="padding:8px 16px;border-radius:8px;text-decoration:none;">
                <i class="fa-solid fa-plus"></i> افزودن پروژه جدید
            </a>
        </div>

        @if(session('success'))
            <div style="background:rgba(16,185,129,0.1);border:1px solid #10b981;color:#10b981;padding:12px;border-radius:8px;margin-bottom:20px;">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div style="background:rgba(239,68,68,0.1);border:1px solid #ef4444;color:#ef4444;padding:12px;border-radius:8px;margin-bottom:20px;">{{ session('error') }}</div>
        @endif

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="border-bottom:1px solid var(--border);">
                        <th style="padding:12px;text-align:right;">#</th>
                        <th style="padding:12px;text-align:right;">تصویر</th>
                        <th style="padding:12px;text-align:right;">عنوان</th>
                        <th style="padding:12px;text-align:right;">کارفرما</th>
                        <th style="padding:12px;text-align:right;">سال</th>
                        <th style="padding:12px;text-align:right;">وضعیت</th>
                        <th style="padding:12px;text-align:right;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $index => $project)
                        <tr style="border-bottom:1px solid var(--border);">
                            <td style="padding:12px;">{{ $projects->firstItem() + $index }}</td>
                            <td style="padding:12px;">
                                @if($project->image_url)
                                    <img src="{{ asset('storage/' . $project->image_url) }}" style="width:45px;height:45px;object-fit:cover;border-radius:6px;border:1px solid var(--border);">
                                @else
                                    <span style="color:var(--text-dimmer);font-size:0.8rem;">بدون تصویر</span>
                                @endif
                            </td>
                            <td style="padding:12px;font-weight:600;">{{ $project->title }}</td>
                            <td style="padding:12px;">{{ $project->client_name ?? '-' }}</td>
                            <td style="padding:12px;">{{ $project->launch_year ?? '-' }}</td>
                            <td style="padding:12px;">
                                @if($project->stats->count() > 0)
                                    <span style="background:rgba(16,185,129,0.2);color:#10b981;padding:2px 10px;border-radius:10px;font-size:12px;">فعال</span>
                                @else
                                    <span style="background:rgba(239,68,68,0.2);color:#ef4444;padding:2px 10px;border-radius:10px;font-size:12px;">ناقص</span>
                                @endif
                            </td>
                            <td style="padding:12px;">
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning" style="margin-left:3px;padding:6px 10px;border-radius:6px;text-decoration:none;display:inline-block;background:#f59e0b;color:#fff;">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('آیا از حذف این پروژه اطمینان دارید؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="padding:6px 10px;border-radius:6px;border:none;cursor:pointer;background:#ef4444;color:#fff;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:40px;color:var(--text-dimmer);">
                                <i class="fa-solid fa-inbox" style="font-size:2rem;display:block;margin-bottom:10px;opacity:0.3;"></i>
                                هیچ پروژه‌ای یافت نشد
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;display:flex;justify-content:center;">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection