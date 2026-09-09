@extends('admin.panel')

@section('content')
    <style>
        /* استایل‌های جدول نظرات - هماهنگ با تم و ریسپانسیو */
        .comment-manage-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 20px;
        }

        .comment-manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .comment-manage-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .comment-count-badge {
            background: #10b981;
            color: white;
            padding: 2px 10px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-add-comment {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--brand), var(--accent-2));
            color: var(--oncta);
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s var(--ease);
            border: none;
            cursor: pointer;
        }

        .btn-add-comment:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        .alert-success-comment {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .comment-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
        }

        .comment-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        .comment-table th {
            background: var(--surface-2);
            color: var(--text-dim);
            font-weight: 700;
            font-size: 0.85rem;
            text-align: right;
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            white-space: nowrap;
        }

        .comment-table th:last-child {
            border-left: none;
        }

        .comment-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            color: var(--text-dim);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .comment-table td:last-child {
            border-left: none;
        }

        .comment-table tbody tr:last-child td {
            border-bottom: none;
        }

        .comment-table tbody tr:hover td {
            background: var(--card-hover);
            transition: background 0.2s ease;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 99px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .status-approved {
            background: #10b981;
            color: #fff;
        }

        .status-pending {
            background: #f59e0b;
            color: #fff;
        }

        .comment-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s var(--ease);
            border: none;
            cursor: pointer;
        }

        .btn-icon-approve {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid #10b981;
        }

        .btn-icon-approve:hover {
            background: #10b981;
            color: #fff;
        }

        .btn-icon-unapprove {
            background: rgba(107, 114, 128, 0.1);
            color: #6b7280;
            border: 1px solid #6b7280;
        }

        .btn-icon-unapprove:hover {
            background: #6b7280;
            color: #fff;
        }

        .btn-icon-edit {
            background: rgba(255, 176, 32, 0.1);
            color: var(--accent);
            border: 1px solid var(--accent);
        }

        .btn-icon-edit:hover {
            background: var(--accent);
            color: var(--oncta);
        }

        .btn-icon-delete {
            background: rgba(220, 38, 38, 0.1);
            color: #dc2626;
            border: 1px solid #dc2626;
        }

        .btn-icon-delete:hover {
            background: #dc2626;
            color: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--text-dimmer);
            font-size: 0.95rem;
        }

        .empty-state i {
            display: block;
            font-size: 2rem;
            margin-bottom: 10px;
            opacity: 0.6;
        }

        .comment-pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .comment-pagination nav {
            display: flex;
            gap: 5px;
        }

        .comment-pagination .page-link {
            color: var(--brand);
            border: 1px solid var(--line);
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            background: var(--surface);
            transition: all 0.2s;
        }

        .comment-pagination .page-link:hover {
            background: var(--card-hover);
        }

        .comment-pagination .page-item.active .page-link {
            background: var(--brand);
            color: var(--oncta);
            border-color: var(--brand);
        }

        .comment-pagination .page-item.disabled .page-link {
            opacity: 0.5;
            pointer-events: none;
        }

        /* ===== ریسپانسیو موبایل: تبدیل جدول به کارت ===== */
        @media (max-width: 768px) {
            .comment-table-wrapper {
                overflow-x: visible;
                border: none;
                background: transparent;
            }

            .comment-table {
                min-width: 0;
                display: block;
            }

            .comment-table thead {
                display: none;
            }

            .comment-table tbody {
                display: block;
            }

            .comment-table tr {
                display: block;
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 15px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .comment-table td {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                border: none;
                border-bottom: 1px solid var(--line);
                padding: 10px 5px;
                font-size: 0.85rem;
                text-align: left;
            }

            .comment-table td:last-child {
                border-bottom: none;
            }

            .comment-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--text-dim);
                margin-left: auto;
                white-space: nowrap;
            }

            .comment-table .comment-actions {
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .comment-table .comment-actions::before {
                display: none;
            }

            .empty-state {
                padding: 20px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="comment-manage-card">
            <div class="comment-manage-header">
                <h5 class="comment-manage-title">
                    <i class="fa-solid fa-comments"></i> مدیریت نظرات
                    <span class="comment-count-badge">
                        {{ \App\Models\Comments::where('is_approved', true)->count() }}
                    </span>
                </h5>
                <a href="{{ route('comments.create') }}" class="btn-add-comment">
                    <i class="fa-solid fa-plus"></i> افزودن نظر
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success-comment">
                    {{ session('success') }}
                </div>
            @endif

            <div class="comment-table-wrapper">
                <table class="comment-table" id="commentTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>کاربر</th>
                            <th>متن نظر</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comments as $index => $comment)
                            <tr>
                                <td>{{ $comments->firstItem() + $index }}</td>
                                <td>{{ $comment->user_name }}</td>
                                <td>{{ Str::limit($comment->content, 60) }}</td>
                                <td>
                                    @if($comment->is_approved)
                                        <span class="status-badge status-approved">تایید شده</span>
                                    @else
                                        <span class="status-badge status-pending">در انتظار</span>
                                    @endif
                                </td>
                                <td>{{ $comment->created_at->format('Y/m/d H:i') }}</td>
                                <td>
                                    <div class="comment-actions">
                                        @if(!$comment->is_approved)
                                            <a href="{{ route('comments.approve', $comment->id) }}"
                                                class="btn-icon btn-icon-approve" onclick="return confirm('تایید این نظر؟');"
                                                title="تایید">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('comments.unapprove', $comment->id) }}"
                                                class="btn-icon btn-icon-unapprove"
                                                onclick="return confirm('عدم تایید و انتقال به در انتظار؟');" title="عدم تایید">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn-icon btn-icon-edit"
                                            title="ویرایش">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>

                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                            style="display: inline-block;"
                                            onsubmit="return confirm('آیا از حذف این نظر اطمینان دارید؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-icon-delete" title="حذف">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="fa-solid fa-inbox"></i> هیچ نظری یافت نشد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="comment-pagination">
                {{ $comments->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('commentTable');
            if (!table) return;

            // استخراج متن هدرها
            const headers = [];
            table.querySelectorAll('thead th').forEach(th => headers.push(th.textContent.trim()));

            // افزودن data-label به هر td بر اساس ایندکس ستون
            table.querySelectorAll('tbody tr').forEach(row => {
                row.querySelectorAll('td').forEach((td, index) => {
                    if (headers[index]) {
                        td.setAttribute('data-label', headers[index]);
                    }
                });
            });
        });
    </script>
@endsection