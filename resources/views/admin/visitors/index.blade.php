@extends('admin.panel')

@section('content')
    <style>
        /* استایل‌های جدول بازدیدکنندگان - هماهنگ با تم و ریسپانسیو */
        .visitor-manage-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 20px;
        }

        .visitor-manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .visitor-manage-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
        }

        .alert-success-visitor {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .visitor-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
        }

        .visitor-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .visitor-table th {
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

        .visitor-table th:last-child {
            border-left: none;
        }

        .visitor-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            color: var(--text-dim);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .visitor-table td:last-child {
            border-left: none;
        }

        .visitor-table tbody tr:last-child td {
            border-bottom: none;
        }

        .visitor-table tbody tr:hover td {
            background: var(--card-hover);
            transition: background 0.2s ease;
        }

        .visitor-actions {
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

        .visitor-pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .visitor-pagination nav {
            display: flex;
            gap: 5px;
        }

        .visitor-pagination .page-link {
            color: var(--brand);
            border: 1px solid var(--line);
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            background: var(--surface);
            transition: all 0.2s;
        }

        .visitor-pagination .page-link:hover {
            background: var(--card-hover);
        }

        .visitor-pagination .page-item.active .page-link {
            background: var(--brand);
            color: var(--oncta);
            border-color: var(--brand);
        }

        .visitor-pagination .page-item.disabled .page-link {
            opacity: 0.5;
            pointer-events: none;
        }

        /* ===== ریسپانسیو موبایل: تبدیل جدول به کارت ===== */
        @media (max-width: 768px) {
            .visitor-table-wrapper {
                overflow-x: visible;
                border: none;
                background: transparent;
            }

            .visitor-table {
                min-width: 0;
                display: block;
            }

            .visitor-table thead {
                display: none;
            }

            .visitor-table tbody {
                display: block;
            }

            .visitor-table tr {
                display: block;
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 15px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            }

            .visitor-table td {
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

            .visitor-table td:last-child {
                border-bottom: none;
            }

            .visitor-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--text-dim);
                margin-left: auto;
                white-space: nowrap;
            }

            .visitor-table .visitor-actions {
                justify-content: flex-start;
            }

            .visitor-table .visitor-actions::before {
                display: none;
            }

            .empty-state {
                padding: 20px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="visitor-manage-card">
            <div class="visitor-manage-header">
                <h5 class="visitor-manage-title">
                    <i class="fa-solid fa-users"></i> بازدیدکنندگان
                </h5>
            </div>

            @if(session('success'))
                <div class="alert-success-visitor">
                    {{ session('success') }}
                </div>
            @endif

            <div class="visitor-table-wrapper">
                <table class="visitor-table" id="visitorTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>IP</th>
                            <th>کشور</th>
                            <th>منطقه</th>
                            <th>تاریخ بازدید</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visitors as $index => $visitor)
                            <tr>
                                <td>{{ $visitors->firstItem() + $index }}</td>
                                <td>{{ $visitor->ip_address ?? '-' }}</td>
                                <td>{{ $visitor->country ?? '-' }}</td>
                                <td>{{ $visitor->region ?? '-' }}</td>
                                <td>{{ $visitor->visited_at ? $visitor->visited_at->format('Y/m/d H:i') : '-' }}</td>
                                <td>
                                    <div class="visitor-actions">
                                        <form action="{{ route('visitors.destroy', $visitor->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('آیا از حذف این بازدیدکننده اطمینان دارید؟');">
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
                                    <i class="fa-solid fa-inbox"></i> هیچ بازدیدکننده‌ای یافت نشد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="visitor-pagination">
                {{ $visitors->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('visitorTable');
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