@extends('admin.panel')

@section('content')
    <style>
        /* استایل‌های جدول کاربران - هماهنگ با تم و ریسپانسیو */
        .user-manage-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 20px;
        }

        .user-manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .user-manage-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
        }

        .btn-add-user {
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

        .btn-add-user:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        .alert-success-user {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .user-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        .user-table th {
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

        .user-table th:last-child {
            border-left: none;
        }

        .user-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            color: var(--text-dim);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .user-table td:last-child {
            border-left: none;
        }

        .user-table tbody tr:last-child td {
            border-bottom: none;
        }

        .user-table tbody tr:hover td {
            background: var(--card-hover);
            transition: background 0.2s ease;
        }

        .role-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 99px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #fff;
        }

        .role-admin {
            background: #6366f1;
        }

        .role-teacher {
            background: #10b981;
        }

        .role-student {
            background: #f59e0b;
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 6px;
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
            border: 1px solid transparent;
        }

        .btn-icon-edit {
            background: rgba(255, 176, 32, 0.1);
            color: var(--accent);
            border-color: var(--accent);
        }

        .btn-icon-edit:hover {
            background: var(--accent);
            color: var(--oncta);
        }

        .btn-icon-delete {
            background: rgba(220, 38, 38, 0.1);
            color: #dc2626;
            border-color: #dc2626;
            border: none;
            cursor: pointer;
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

        .user-pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .user-pagination nav {
            display: flex;
            gap: 5px;
        }

        .user-pagination .page-link {
            color: var(--brand);
            border: 1px solid var(--line);
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            background: var(--surface);
            transition: all 0.2s;
        }

        .user-pagination .page-link:hover {
            background: var(--card-hover);
        }

        .user-pagination .page-item.active .page-link {
            background: var(--brand);
            color: var(--oncta);
            border-color: var(--brand);
        }

        .user-pagination .page-item.disabled .page-link {
            opacity: 0.5;
            pointer-events: none;
        }

        /* ===== ریسپانسیو موبایل: تبدیل جدول به کارت ===== */
        @media (max-width: 768px) {
            .user-table-wrapper {
                overflow-x: visible;
                border: none;
                background: transparent;
            }

            .user-table {
                min-width: 0;
                display: block;
            }

            .user-table thead {
                display: none;
            }

            .user-table tbody {
                display: block;
            }

            .user-table tr {
                display: block;
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 15px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .user-table td {
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

            .user-table td:last-child {
                border-bottom: none;
            }

            .user-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--text-dim);
                margin-left: auto;
                white-space: nowrap;
            }

            .user-table .user-actions {
                justify-content: flex-start;
            }

            .user-table .user-actions::before {
                display: none;
            }

            .empty-state {
                padding: 20px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="user-manage-card">
            <div class="user-manage-header">
                <h5 class="user-manage-title">
                    <i class="fa-solid fa-users"></i> مدیریت کاربران
                </h5>
                <a href="{{ route('users.create') }}" class="btn-add-user">
                    <i class="fa-solid fa-plus"></i> افزودن کاربر جدید
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success-user">
                    {{ session('success') }}
                </div>
            @endif

            <div class="user-table-wrapper">
                <table class="user-table" id="userTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>نقش</th>
                            <th>تاریخ عضویت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="role-badge role-admin">ادمین</span>
                                    @elseif($user->role == 'teacher')
                                        <span class="role-badge role-teacher">استاد</span>
                                    @else
                                        <span class="role-badge role-student">دانشجو</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at ? $user->created_at->format('Y/m/d') : '-' }}</td>
                                <td>
                                    <div class="user-actions">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn-icon btn-icon-edit"
                                            title="ویرایش">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            style="display: inline-block;"
                                            onsubmit="return confirm('آیا از حذف این کاربر اطمینان دارید؟');">
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
                                    <i class="fa-solid fa-inbox"></i> هیچ کاربری یافت نشد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="user-pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('userTable');
            if (!table) return;

            const headers = [];
            table.querySelectorAll('thead th').forEach(th => headers.push(th.textContent.trim()));

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