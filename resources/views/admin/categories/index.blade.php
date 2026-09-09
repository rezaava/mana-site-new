```blade
@extends('admin.panel')

@section('content')
    <style>
        /* استایل‌های جدول دسته‌بندی‌ها - هماهنگ با تم و ریسپانسیو */
        .category-manage-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 20px;
        }

        .category-manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .category-manage-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
        }

        .btn-add-category {
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

        .btn-add-category:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        .alert-success-category {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .category-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
        }

        .category-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 500px;
        }

        .category-table th {
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

        .category-table th:last-child {
            border-left: none;
        }

        .category-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            color: var(--text-dim);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .category-table td:last-child {
            border-left: none;
        }

        .category-table tbody tr:last-child td {
            border-bottom: none;
        }

        .category-table tbody tr:hover td {
            background: var(--card-hover);
            transition: background 0.2s ease;
        }

        .category-actions {
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
            .category-table-wrapper {
                overflow-x: visible;
                border: none;
                background: transparent;
            }

            .category-table {
                min-width: 0;
                display: block;
            }

            .category-table thead {
                display: none;
            }

            .category-table tbody {
                display: block;
            }

            .category-table tr {
                display: block;
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 15px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .category-table td {
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

            .category-table td:last-child {
                border-bottom: none;
            }

            .category-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--text-dim);
                margin-left: auto;
                white-space: nowrap;
            }

            .category-table .category-actions {
                justify-content: flex-start;
            }

            .category-table .category-actions::before {
                display: none;
            }

            .empty-state {
                padding: 20px;
            }
        }
    </style>

    <div style="padding:20px;">
        <div class="category-manage-card">
            <div class="category-manage-header">
                <h5 class="category-manage-title">
                    <i class="fa-solid fa-tags"></i> دسته‌بندی‌ها
                </h5>
                <a href="{{ route('categories.create') }}" class="btn-add-category">
                    <i class="fa-solid fa-plus"></i> افزودن دسته‌بندی
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success-category">{{ session('success') }}</div>
            @endif

            <div class="category-table-wrapper">
                <table class="category-table" id="categoryTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $i => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $i }}</td>
                                <td>{{ $category->name ?? $category->title }}</td>
                                <td>
                                    <div class="category-actions">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn-icon btn-icon-edit"
                                            title="ویرایش">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            style="display:inline;" onsubmit="return confirm('حذف شود؟')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-icon btn-icon-delete" title="حذف">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="empty-state">
                                    <i class="fa-solid fa-inbox"></i> دسته‌بندی‌ای نیست
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
            const table = document.getElementById('categoryTable');
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
```