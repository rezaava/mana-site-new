@extends('admin.panel')

@section('content')

    <style>
        .social-manage-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 20px;
        }

        .social-manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .social-manage-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-add-social {
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

        .btn-add-social:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        .alert-success-social {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-error-social {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid #ef4444;
            color: #ef4444;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .social-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
        }

        .social-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        .social-table th {
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

        .social-table th:last-child {
            border-left: none;
        }

        .social-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            color: var(--text-dim);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .social-table td:last-child {
            border-left: none;
        }

        .social-table tbody tr:last-child td {
            border-bottom: none;
        }

        .social-table tbody tr:hover td {
            background: var(--card-hover);
            transition: background 0.2s ease;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--surface-2);
            color: var(--text);
            font-size: 20px;
        }

        .social-icon-class {
            direction: ltr;
            text-align: left;
            font-family: monospace;
            font-size: 0.82rem;
            color: var(--text-dim);
        }

        .social-url {
            color: #3b82f6;
            text-decoration: none;
            direction: ltr;
            display: inline-block;
            max-width: 350px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .social-url:hover {
            text-decoration: underline;
        }

        .social-actions {
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

        .social-pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .social-pagination nav {
            display: flex;
            gap: 5px;
        }

        .social-pagination .page-link {
            color: var(--brand);
            border: 1px solid var(--line);
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            background: var(--surface);
            transition: all 0.2s;
        }

        .social-pagination .page-link:hover {
            background: var(--card-hover);
        }

        .social-pagination .page-item.active .page-link {
            background: var(--brand);
            color: var(--oncta);
            border-color: var(--brand);
        }

        .social-pagination .page-item.disabled .page-link {
            opacity: 0.5;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .social-table-wrapper {
                overflow-x: visible;
                border: none;
                background: transparent;
            }

            .social-table {
                min-width: 0;
                display: block;
            }

            .social-table thead {
                display: none;
            }

            .social-table tbody {
                display: block;
            }

            .social-table tr {
                display: block;
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 15px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .social-table td {
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

            .social-table td:last-child {
                border-bottom: none;
            }

            .social-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--text-dim);
                margin-left: auto;
                white-space: nowrap;
            }

            .social-table td[data-label="آیکون"] {
                justify-content: flex-start;
            }

            .social-table td[data-label="آیکون"]::before {
                margin-left: 0;
                margin-right: auto;
            }

            .social-table .social-actions {
                justify-content: flex-start;
            }

            .social-table .social-actions::before {
                display: none;
            }

            .social-icon {
                width: 45px;
                height: 45px;
                font-size: 22px;
            }

            .social-url {
                max-width: 220px;
            }

            .social-icon-class {
                max-width: 180px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .empty-state {
                padding: 20px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="social-manage-card">

            <div class="social-manage-header">

                <h5 class="social-manage-title">
                    <i class="fa-solid fa-share-nodes"></i>
                    مدیریت شبکه‌های اجتماعی
                </h5>

                <a href="{{ route('socials.create') }}" class="btn-add-social">
                    <i class="fa-solid fa-plus"></i>
                    افزودن شبکه جدید
                </a>

            </div>

            @if (session('success'))
                <div class="alert-success-social">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert-error-social">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="social-table-wrapper">

                <table class="social-table" id="socialTable">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>آیکون</th>
                            <th>نام شبکه</th>
                            <th>کلاس آیکون</th>
                            <th>آدرس (URL)</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($socials as $social)

                            <tr>

                                <td>
                                    {{ $social->id }}
                                </td>

                                <td>
                                    <span class="social-icon">
                                        <i class="fa-brands  {{ $social->icon_class }}"></i>
                                    </span>
                                </td>

                                <td>
                                    {{ $social->name }}
                                </td>

                                <td>
                                    <span class="social-icon-class">
                                        {{ $social->icon_class }}
                                    </span>
                                </td>

                                <td>
                                    <a
                                        href="{{ $social->url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="social-url"
                                    >
                                        {{ $social->url }}
                                    </a>
                                </td>

                                <td>

                                    <div class="social-actions">

                                        <a
                                            href="{{ route('socials.edit', $social->id) }}"
                                            class="btn-icon btn-icon-edit"
                                            title="ویرایش"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <form
                                            action="{{ route('socials.destroy', $social->id) }}"
                                            method="POST"
                                            style="margin: 0;"
                                            onsubmit="return confirm('آیا از حذف این مورد اطمینان دارید؟')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn-icon btn-icon-delete"
                                                title="حذف"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="fa-solid fa-inbox"></i>
                                    هیچ شبکه اجتماعی یافت نشد.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="social-pagination">
                {{ $socials->links() }}
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const table = document.getElementById('socialTable');

            if (!table) {
                return;
            }

            const headers = [];

            table.querySelectorAll('thead th').forEach(function (th) {
                headers.push(th.textContent.trim());
            });

            table.querySelectorAll('tbody tr').forEach(function (row) {

                row.querySelectorAll('td').forEach(function (td, index) {

                    if (headers[index]) {
                        td.setAttribute('data-label', headers[index]);
                    }

                });

            });

        });
    </script>

@endsection