@extends('admin.panel')

@section('content')
    <style>
        /* استایل‌های جدول خدمات - هماهنگ با تم و ریسپانسیو */
        .service-manage-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 20px;
        }

        .service-manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .service-manage-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
        }

        .btn-add-service {
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

        .btn-add-service:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        .alert-success-service {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .service-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
        }

        .service-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .service-table th {
            background: var(--surface-2);
            color: var(--text);
            font-weight: 700;
            font-size: 0.85rem;
            text-align: right;
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            white-space: nowrap;
        }

        .service-table th:last-child {
            border-left: none;
        }

        .service-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            color: var(--text-dim);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .service-table td:last-child {
            border-left: none;
        }

        .service-table tbody tr:last-child td {
            border-bottom: none;
        }

        .service-table tbody tr:hover td {
            background: var(--card-hover);
            transition: background 0.2s ease;
        }

        .service-thumb {
            width: 60px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--line);
        }

        .service-actions {
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

        .service-pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .service-pagination nav {
            display: flex;
            gap: 5px;
        }

        .service-pagination .page-link {
            color: var(--brand);
            border: 1px solid var(--line);
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            background: var(--surface);
            transition: all 0.2s;
        }

        .service-pagination .page-link:hover {
            background: var(--card-hover);
        }

        .service-pagination .page-item.active .page-link {
            background: var(--brand);
            color: var(--oncta);
            border-color: var(--brand);
        }

        .service-pagination .page-item.disabled .page-link {
            opacity: 0.5;
            pointer-events: none;
        }

        /* ===== ریسپانسیو موبایل: تبدیل جدول به کارت ===== */
        @media (max-width: 768px) {
            .service-table-wrapper {
                overflow-x: visible;
                border: none;
                background: transparent;
            }

            .service-table {
                min-width: 0;
                display: block;
            }

            .service-table thead {
                display: none;
            }

            .service-table tbody {
                display: block;
            }

            .service-table tr {
                display: block;
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 15px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .service-table td {
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

            .service-table td:last-child {
                border-bottom: none;
            }

            .service-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--text-dim);
                margin-left: auto;
                white-space: nowrap;
            }

            .service-table td[data-label="تصویر"] {
                justify-content: flex-start;
            }

            .service-table td[data-label="تصویر"]::before {
                margin-left: 0;
                margin-right: auto;
            }

            .service-table .service-actions {
                justify-content: flex-start;
            }

            .service-table .service-actions::before {
                display: none;
            }

            .service-thumb {
                width: 50px;
                height: 50px;
            }

            .empty-state {
                padding: 20px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="service-manage-card">
            <div class="service-manage-header">
                <h5 class="service-manage-title">
                    <i class="fa-solid fa-layer-group"></i> مدیریت خدمات
                </h5>
                <a href="{{ route('pages.create') }}" class="btn-add-service">
                    <i class="fa-solid fa-plus"></i> افزودن خدمت جدید
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success-service">
                    {{ session('success') }}
                </div>
            @endif

            <div class="service-table-wrapper">
                <table class="service-table" id="serviceTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>شماره</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $index => $service)
                            <tr>
                                <td>{{ $services->firstItem() + $index }}</td>
                                <td>
                                    @if($service->image_url)
                                        <img src="{{asset('storage/' . $service->image_url)}}" alt="{{ $service->title }}"
                                            class="service-thumb">
                                    @else
                                        <span style="color: var(--text-dimmer);">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->number ?? '-' }}</td>
                                <td>
                                    <div class="service-actions">
                                        <a href="{{ route('pages.edit', $service->id) }}" class="btn-icon btn-icon-edit"
                                            title="ویرایش">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pages.destroy', $service->id) }}" method="POST"
                                            style="display: inline-block;"
                                            onsubmit="return confirm('آیا از حذف این خدمت اطمینان دارید؟');">
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
                                    <i class="fa-solid fa-inbox"></i> هیچ خدمتی یافت نشد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="service-pagination">
                {{ $services->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('serviceTable');
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