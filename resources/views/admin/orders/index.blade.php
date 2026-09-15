@extends('admin.panel')

@section('content')
    <style>
        /* استایل‌های جدول سفارشات - هماهنگ با جدول‌های قبلی */
        .order-manage-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 20px;
        }

        .order-manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .order-manage-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .orders-count {
            min-width: 27px;
            height: 27px;
            padding: 0 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 99px;
            background: linear-gradient(135deg, var(--brand), var(--accent-2));
            color: var(--oncta);
            font-size: 0.78rem;
            font-weight: 700;
        }

        .alert-success-order {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .order-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .order-table th {
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

        .order-table th:last-child {
            border-left: none;
        }

        .order-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            color: var(--text-dim);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .order-table td:last-child {
            border-left: none;
        }

        .order-table tbody tr:last-child td {
            border-bottom: none;
        }

        .order-table tbody tr:hover td {
            background: var(--card-hover);
            transition: background 0.2s ease;
        }

        .order-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 30px;
            border-radius: 7px;
            background: var(--surface-2);
            color: var(--text-dim);
            font-size: 0.75rem;
            font-weight: 700;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 37px;
            height: 37px;
            min-width: 37px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(59, 130, 246, 0.15));
            color: #8b5cf6;
            font-size: 0.9rem;
        }

        .user-name {
            color: var(--text);
            font-weight: 700;
            font-size: 0.88rem;
            margin-bottom: 2px;
        }

        .user-email {
            color: var(--text-dimmer);
            font-size: 0.75rem;
        }

        .order-phone {
            direction: ltr;
            text-align: right;
            display: inline-block;
            color: var(--text-dim);
            font-weight: 500;
        }

        .service-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 99px;
            background: color-mix(in srgb, var(--brand) 12%, transparent);
            color: var(--brand);
            font-size: 0.78rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .service-badge i {
            font-size: 0.75rem;
        }

        .order-actions {
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
            cursor: pointer;
        }

        .btn-icon-view {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border-color: #3b82f6;
        }

        .btn-icon-view:hover {
            background: #3b82f6;
            color: #fff;
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

        .empty-state strong {
            display: block;
            color: var(--text-dim);
            font-size: 0.95rem;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .empty-state span {
            font-size: 0.85rem;
        }

        .order-pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .order-pagination nav {
            display: flex;
            gap: 5px;
        }

        .order-pagination .page-link {
            color: var(--brand);
            border: 1px solid var(--line);
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            background: var(--surface);
            transition: all 0.2s;
        }

        .order-pagination .page-link:hover {
            background: var(--card-hover);
        }

        .order-pagination .page-item.active .page-link {
            background: var(--brand);
            color: var(--oncta);
            border-color: var(--brand);
        }

        .order-pagination .page-item.disabled .page-link {
            opacity: 0.5;
            pointer-events: none;
        }

        /* ===== ریسپانسیو موبایل: تبدیل جدول به کارت ===== */
        @media (max-width: 768px) {
            .order-table-wrapper {
                overflow-x: visible;
                border: none;
                background: transparent;
            }

            .order-table {
                min-width: 0;
                display: block;
            }

            .order-table thead {
                display: none;
            }

            .order-table tbody {
                display: block;
            }

            .order-table tr {
                display: block;
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 15px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .order-table td {
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

            .order-table td:last-child {
                border-bottom: none;
            }

            .order-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--text-dim);
                margin-left: auto;
                white-space: nowrap;
            }

            .order-table td[data-label="کاربر"] {
                justify-content: flex-start;
            }

            .order-table td[data-label="کاربر"]::before {
                margin-left: 0;
                margin-right: auto;
            }

            .order-table .order-actions {
                justify-content: flex-start;
            }

            .order-table .order-actions::before {
                display: none;
            }

            .empty-state {
                padding: 20px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="order-manage-card">
            <div class="order-manage-header">
                <h5 class="order-manage-title">
                    <i class="fa-solid fa-file-invoice"></i> مدیریت سفارشات

                    @if($orders->count() > 0)
                        <span class="orders-count">{{ $orders->count() }}</span>
                    @endif
                </h5>
            </div>

            @if(session('success'))
                <div class="alert-success-order">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="order-table-wrapper">
                <table class="order-table" id="orderTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>کاربر</th>
                            <th>شماره تماس</th>
                            <th>خدمت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $index => $order)
                            <tr>
                                <td>
                                    <span class="order-number">
                                        {{ $orders->firstItem() + $index }}
                                    </span>
                                </td>

                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div>
                                            <div class="user-name">{{ $order->fullname }}</div>
                                            <div class="user-email">{{ $order->email ?? 'بدون ایمیل' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="order-phone">{{ $order->phone }}</span>
                                </td>

                                <td>
                                    @if($order->service)
                                        <span class="service-badge">
                                            <i class="fa-solid {{ $order->service->icon ?? 'fa-layer-group' }}"></i>
                                            {{ $order->service->title }}
                                        </span>
                                    @else
                                        <span style="color: var(--text-dimmer);">-</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="order-actions">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn-icon btn-icon-view"
                                            title="مشاهده">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <form action="{{ route('orders.delete', $order->id) }}" method="POST"
                                            style="display: inline-block;"
                                            onsubmit="return confirm('آیا از حذف این سفارش اطمینان دارید؟');">
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
                                <td colspan="5" class="empty-state">
                                    <i class="fa-solid fa-inbox"></i>
                                    <strong>هیچ سفارشی ثبت نشده</strong>
                                    <span>در حال حاضر هیچ سفارشی وجود ندارد.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="order-pagination">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('orderTable');
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