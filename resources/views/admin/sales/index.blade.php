@extends('admin.panel')

@section('content')
    <style>
        /* استایل‌های جدول فروش - هماهنگ با تم و ریسپانسیو */
        .sales-manage-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 20px;
        }

        .sales-manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .sales-manage-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
        }

        .btn-add-sale {
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

        .btn-add-sale:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        .alert-success-sale {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .sales-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
        }

        .sales-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .sales-table th {
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

        .sales-table th:last-child {
            border-left: none;
        }

        .sales-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            color: var(--text-dim);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .sales-table td:last-child {
            border-left: none;
        }

        .sales-table tbody tr:last-child td {
            border-bottom: none;
        }

        .sales-table tbody tr:hover td {
            background: var(--card-hover);
            transition: background 0.2s ease;
        }

        .sale-thumb {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--line);
        }

        .sale-actions {
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

        .sales-pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .sales-pagination nav {
            display: flex;
            gap: 5px;
        }

        .sales-pagination .page-link {
            color: var(--brand);
            border: 1px solid var(--line);
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            background: var(--surface);
            transition: all 0.2s;
        }

        .sales-pagination .page-link:hover {
            background: var(--card-hover);
        }

        .sales-pagination .page-item.active .page-link {
            background: var(--brand);
            color: var(--oncta);
            border-color: var(--brand);
        }

        .sales-pagination .page-item.disabled .page-link {
            opacity: 0.5;
            pointer-events: none;
        }

        /* ===== ریسپانسیو موبایل: تبدیل جدول به کارت ===== */
        @media (max-width: 768px) {
            .sales-table-wrapper {
                overflow-x: visible;
                border: none;
                background: transparent;
            }

            .sales-table {
                min-width: 0;
                display: block;
            }

            .sales-table thead {
                display: none;
            }

            .sales-table tbody {
                display: block;
            }

            .sales-table tr {
                display: block;
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 15px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .sales-table td {
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

            .sales-table td:last-child {
                border-bottom: none;
            }

            .sales-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--text-dim);
                margin-left: auto;
                white-space: nowrap;
            }

            .sales-table td[data-label="تصویر"] {
                justify-content: flex-start;
            }

            .sales-table td[data-label="تصویر"]::before {
                margin-left: 0;
                margin-right: auto;
            }

            .sales-table .sale-actions {
                justify-content: flex-start;
            }

            .sales-table .sale-actions::before {
                display: none;
            }

            .sale-thumb {
                width: 50px;
                height: 50px;
            }

            .empty-state {
                padding: 20px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="sales-manage-card">
            <div class="sales-manage-header">
                <h5 class="sales-manage-title">
                    <i class="fa-solid fa-chart-bar"></i> مدیریت فروش
                </h5>
                <a href="{{ route('sales.create') }}" class="btn-add-sale">
                    <i class="fa-solid fa-plus"></i> افزودن محصول جدید
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success-sale">
                    {{ session('success') }}
                </div>
            @endif

            <div class="sales-table-wrapper">
                <table class="sales-table" id="salesTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>قیمت</th>
                            <th>شماره</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $index => $sale)
                            <tr>
                                <td>{{ $sales->firstItem() + $index }}</td>
                                <td>
                                    @if($sale->image_url)
                                        <img src="{{ asset('storage/' . $sale->image_url) }}" alt="{{ $sale->title }}"
                                            class="sale-thumb">
                                    @else
                                        <span style="color: var(--text-dimmer);">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>{{ $sale->title }}</td>
                                <td>{{ $sale->price ? number_format($sale->price) . ' تومان' : '-' }}</td>
                                <td>{{ $sale->number ?? '-' }}</td>
                                <td>
                                    <div class="sale-actions">
                                        <a href="{{ route('sales.edit', $sale->id) }}" class="btn-icon btn-icon-edit"
                                            title="ویرایش">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST"
                                            style="display: inline-block;"
                                            onsubmit="return confirm('آیا از حذف این محصول اطمینان دارید؟');">
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
                                    <i class="fa-solid fa-inbox"></i> هیچ محصولی یافت نشد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="sales-pagination">
                {{ $sales->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('salesTable');
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