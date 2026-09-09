@extends('admin.panel')

@section('content')
    <style>
        /* استایل‌های جدول اعضای تیم - هماهنگ با تم و ریسپانسیو */
        .team-manage-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 20px;
        }

        .team-manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .team-manage-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
        }

        .btn-add-team {
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

        .btn-add-team:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        .alert-success-team {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .team-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
        }

        .team-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .team-table th {
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

        .team-table th:last-child {
            border-left: none;
        }

        .team-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            color: var(--text-dim);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .team-table td:last-child {
            border-left: none;
        }

        .team-table tbody tr:last-child td {
            border-bottom: none;
        }

        .team-table tbody tr:hover td {
            background: var(--card-hover);
            transition: background 0.2s ease;
        }

        .team-thumb {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%;
            border: 1px solid var(--line);
        }

        .team-actions {
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

        /* ===== ریسپانسیو موبایل: تبدیل جدول به کارت ===== */
        @media (max-width: 768px) {
            .team-table-wrapper {
                overflow-x: visible;
                border: none;
                background: transparent;
            }

            .team-table {
                min-width: 0;
                display: block;
            }

            .team-table thead {
                display: none;
            }

            .team-table tbody {
                display: block;
            }

            .team-table tr {
                display: block;
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 15px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            }

            .team-table td {
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

            .team-table td:last-child {
                border-bottom: none;
            }

            .team-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--text-dim);
                margin-left: auto;
                white-space: nowrap;
            }

            .team-table td[data-label="تصویر"] {
                justify-content: flex-start;
            }

            .team-table td[data-label="تصویر"]::before {
                margin-left: 0;
                margin-right: auto;
            }

            .team-table .team-actions {
                justify-content: flex-start;
            }

            .team-table .team-actions::before {
                display: none;
            }

            .team-thumb {
                width: 50px;
                height: 50px;
            }

            .empty-state {
                padding: 20px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="team-manage-card">
            <div class="team-manage-header">
                <h5 class="team-manage-title">
                    <i class="fa-solid fa-users"></i> مدیریت اعضای تیم
                </h5>
                <a href="{{ route('create_team_form') }}" class="btn-add-team">
                    <i class="fa-solid fa-plus"></i> افزودن عضو جدید
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success-team">
                    {{ session('success') }}
                </div>
            @endif

            <div class="team-table-wrapper">
                <table class="team-table" id="teamTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>نام و نام خانوادگی</th>
                            <th>سمت شغلی</th>
                            <th>ترتیب</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($member->image_url)
                                        <img src="{{ asset('storage/' . $member->image_url) }}" alt="{{ $member->name }}" class="team-thumb">
                                    @else
                                        <span style="color: var(--text-dimmer);">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->title ?? '-' }}</td>
                                <td>{{ $member->number ?? '-' }}</td>
                                <td>
                                    <div class="team-actions">
                                        <a href="{{ route('edit_team_form', $member->id) }}" class="btn-icon btn-icon-edit" title="ویرایش">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('destroy_team', $member->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('آیا از حذف این عضو تیم اطمینان دارید؟');">
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
                                    <i class="fa-solid fa-inbox"></i> هیچ عضوی یافت نشد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('teamTable');
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