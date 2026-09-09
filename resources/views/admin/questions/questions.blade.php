@extends('admin.panel')

@section('content')
    <style>
        /* استایل‌های جدول سوالات متداول - هماهنگ با تم و ریسپانسیو */
        .question-manage-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 20px;
        }

        .question-manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .question-manage-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-add-question {
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

        .btn-add-question:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        .alert-success-question {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-error-question {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid #ef4444;
            color: #ef4444;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .question-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
        }

        .question-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .question-table th {
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

        .question-table th:last-child {
            border-left: none;
        }

        .question-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            border-left: 1px solid var(--line);
            color: var(--text-dim);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .question-table td:last-child {
            border-left: none;
        }

        .question-table tbody tr:last-child td {
            border-bottom: none;
        }

        .question-table tbody tr:hover td {
            background: var(--card-hover);
            transition: background 0.2s ease;
        }

        .number-badge {
            display: inline-block;
            background: var(--surface-2);
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: bold;
            color: var(--text);
        }

        .question-actions {
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
            border: none;
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

        .question-pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .question-pagination nav {
            display: flex;
            gap: 5px;
        }

        .question-pagination .page-link {
            color: var(--brand);
            border: 1px solid var(--line);
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            background: var(--surface);
            transition: all 0.2s;
        }

        .question-pagination .page-link:hover {
            background: var(--card-hover);
        }

        .question-pagination .page-item.active .page-link {
            background: var(--brand);
            color: var(--oncta);
            border-color: var(--brand);
        }

        .question-pagination .page-item.disabled .page-link {
            opacity: 0.5;
            pointer-events: none;
        }

        /* ===== ریسپانسیو موبایل: تبدیل جدول به کارت ===== */
        @media (max-width: 768px) {
            .question-table-wrapper {
                overflow-x: visible;
                border: none;
                background: transparent;
            }

            .question-table {
                min-width: 0;
                display: block;
            }

            .question-table thead {
                display: none;
            }

            .question-table tbody {
                display: block;
            }

            .question-table tr {
                display: block;
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 15px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .question-table td {
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

            .question-table td:last-child {
                border-bottom: none;
            }

            .question-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--text-dim);
                margin-left: auto;
                white-space: nowrap;
            }

            .question-table .question-actions {
                justify-content: flex-start;
            }

            .question-table .question-actions::before {
                display: none;
            }

            .empty-state {
                padding: 20px;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="question-manage-card">
            <div class="question-manage-header">
                <h5 class="question-manage-title">
                    <i class="fa-solid fa-circle-question"></i> مدیریت سوالات متداول
                </h5>
                <a href="{{ route('questions.create') }}" class="btn-add-question">
                    <i class="fa-solid fa-plus"></i> افزودن سوال جدید
                </a>
            </div>

            @if (session('success'))
                <div class="alert-success-question">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert-error-question">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                </div>
            @endif

            <div class="question-table-wrapper">
                <table class="question-table" id="questionTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ترتیب</th>
                            <th>عنوان سوال</th>
                            <th>پاسخ</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $question)
                            <tr>
                                <td>{{ $question->id }}</td>
                                <td>
                                    <span class="number-badge">{{ $question->number }}</span>
                                </td>
                                <td style="font-weight:600;">{{ $question->title }}</td>
                                <td style="color: var(--text-dimmer); font-size: 0.9rem;">
                                    {{ Str::limit($question->answer, 120, '...') }}
                                </td>
                                <td>
                                    <div class="question-actions">
                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn-icon btn-icon-edit"
                                            title="ویرایش">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                            style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-icon-delete" title="حذف"
                                                onclick="return confirm('آیا از حذف این سوال اطمینان دارید؟')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class="fa-solid fa-inbox"></i> هیچ سوالی ثبت نشده است.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="question-pagination">
                {{ $questions->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('questionTable');
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