@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-comments"></i> مدیریت نظرات
                <span style="background: #10b981; color: white; padding: 2px 10px; border-radius: 10px; font-size: 13px; margin-right: 8px;">
                    {{ persianNum(\App\Models\Comment::where('is_approved', true)->count()) }}
                </span>
            </h5>
            <a href="{{ route('comments.create') }}" class="btn btn-sm btn-primary" style="padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                <i class="fa-solid fa-plus"></i> افزودن نظر
            </a>
        </div>

        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border);">
                        <th style="padding: 12px; text-align: right;">#</th>
                        <th style="padding: 12px; text-align: right;">کاربر</th>
                        <th style="padding: 12px; text-align: right;">متن نظر</th>
                        <th style="padding: 12px; text-align: right;">وضعیت</th>
                        <th style="padding: 12px; text-align: right;">تاریخ</th>
                        <th style="padding: 12px; text-align: right;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $index => $comment)
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 12px;">{{ persianNum($comments->firstItem() + $index) }}</td>
                            <td style="padding: 12px;">{{ $comment->user_name }}</td>
                            <td style="padding: 12px;">{{ Str::limit($comment->content, 60) }}</td>
                            <td style="padding: 12px;">
                                @if($comment->is_approved)
                                    <span style="background: #10b981; color: white; padding: 3px 10px; border-radius: 10px; font-size: 12px;">تایید شده</span>
                                @else
                                    <span style="background: #f59e0b; color: white; padding: 3px 10px; border-radius: 10px; font-size: 12px;">در انتظار</span>
                                @endif
                            </td>
                            <td style="padding: 12px;">{{ $comment->created_at->format('Y/m/d H:i') }}</td>
                            <td style="padding: 12px;">
                                @if(!$comment->is_approved)
                                    <a href="{{ route('comments.approve', $comment->id) }}" class="btn btn-sm btn-success" style="margin-left: 3px; display: inline-block; padding: 6px 10px; border-radius: 6px; text-decoration: none;" onclick="return confirm('تایید این نظر؟');">
                                        <i class="fa-solid fa-check"></i>
                                    </a>
                                @endif
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('آیا از حذف این نظر اطمینان دارید؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="padding: 6px 10px; border-radius: 6px; border: none; cursor: pointer;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-light);">
                                <i class="fa-solid fa-inbox"></i> هیچ نظری یافت نشد
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $comments->links() }}
        </div>
    </div>
</div>
@endsection
