@extends('admin.panel')

@section('content')
    <div style="padding: 20px;">
        <style>
            /* استایل‌های جدول مقالات - هماهنگ با تم و ریسپانسیو */
            .blog-manage-card {
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 14px;
                box-shadow: var(--shadow-strong);
                padding: 20px;
            }

            .blog-manage-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .blog-manage-title {
                margin: 0;
                font-size: 1.15rem;
                font-weight: 700;
                color: var(--text);
            }

            .btn-add-blog {
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

            .btn-add-blog:hover {
                filter: brightness(1.1);
                transform: translateY(-1px);
            }

            .alert-success-blog {
                background: rgba(16, 185, 129, 0.1);
                border: 1px solid #10b981;
                color: #10b981;
                padding: 12px;
                border-radius: 8px;
                margin-bottom: 20px;
                font-weight: 500;
            }

            .blog-table-wrapper {
                overflow-x: auto;
                border: 1px solid var(--line);
                border-radius: 10px;
                background: var(--surface);
            }

            .blog-table {
                width: 100%;
                border-collapse: collapse;
                min-width: 600px;
            }

            .blog-table th {
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

            .blog-table th:last-child {
                border-left: none;
            }

            .blog-table td {
                padding: 12px 14px;
                border-bottom: 1px solid var(--line);
                border-left: 1px solid var(--line);
                color: var(--text-dim);
                font-size: 0.88rem;
                vertical-align: middle;
            }

            .blog-table td:last-child {
                border-left: none;
            }

            .blog-table tbody tr:last-child td {
                border-bottom: none;
            }

            .blog-table tbody tr:hover td {
                background: var(--card-hover);
                transition: background 0.2s ease;
            }

            .blog-thumb {
                width: 45px;
                height: 45px;
                object-fit: cover;
                border-radius: 6px;
                border: 1px solid var(--line);
            }

            .blog-actions {
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

            .blog-pagination {
                margin-top: 20px;
                display: flex;
                justify-content: center;
            }

            .blog-pagination nav {
                display: flex;
                gap: 5px;
            }

            .blog-pagination .page-link {
                color: var(--brand);
                border: 1px solid var(--line);
                padding: 6px 12px;
                border-radius: 6px;
                text-decoration: none;
                background: var(--surface);
                transition: all 0.2s;
            }

            .blog-pagination .page-link:hover {
                background: var(--card-hover);
            }

            .blog-pagination .page-item.active .page-link {
                background: var(--brand);
                color: var(--oncta);
                border-color: var(--brand);
            }

            .blog-pagination .page-item.disabled .page-link {
                opacity: 0.5;
                pointer-events: none;
            }

            /* ===== ریسپانسیو موبایل: تبدیل جدول به کارت ===== */
            @media (max-width: 768px) {
                .blog-table-wrapper {
                    overflow-x: visible;
                    border: none;
                    background: transparent;
                }

                .blog-table {
                    min-width: 0;
                    display: block;
                }

                .blog-table thead {
                    display: none;
                }

                .blog-table tbody {
                    display: block;
                }

                .blog-table tr {
                    display: block;
                    background: var(--surface);
                    border: 1px solid var(--line);
                    border-radius: 12px;
                    margin-bottom: 15px;
                    padding: 10px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
                }

                .blog-table td {
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

                .blog-table td:last-child {
                    border-bottom: none;
                }

                .blog-table td::before {
                    content: attr(data-label);
                    font-weight: 700;
                    color: var(--text-dim);
                    margin-left: auto;
                    white-space: nowrap;
                }

                .blog-table td[data-label="تصویر"] {
                    justify-content: flex-start;
                }

                .blog-table td[data-label="تصویر"]::before {
                    margin-left: 0;
                    margin-right: auto;
                }

                .blog-table .blog-actions {
                    justify-content: flex-start;
                }

                .blog-table .blog-actions::before {
                    display: none;
                }

                .blog-thumb {
                    width: 50px;
                    height: 50px;
                }

                .empty-state {
                    padding: 20px;
                }
            }
        </style>

        <div class="blog-manage-card">
            <div class="blog-manage-header">
                <h5 class="blog-manage-title">
                    <i class="fa-solid fa-newspaper"></i> مدیریت مقالات
                </h5>
                <a href="{{ route('blogs.create') }}" class="btn-add-blog">
                    <i class="fa-solid fa-plus"></i> افزودن مقاله جدید
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success-blog">
                    {{ session('success') }}
                </div>
            @endif

            <div class="blog-table-wrapper">
                <table class="blog-table" id="blogTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>زمان مطالعه</th>
                            <th>شماره</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $index => $blog)
                            <tr>
                                <td>{{ $blogs->firstItem() + $index }}</td>
                                <td>
                                    @if($blog->image_url)
                                        <img src="{{ asset('storage/' . $blog->image_url) }}" alt="{{ $blog->title }}"
                                            class="blog-thumb">
                                    @else
                                        <span style="color: var(--text-dimmer);">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->{'reading-time'} ? $blog->{'reading-time'} . ' دقیقه' : '-' }}</td>
                                <td>{{ $blog->number ?? '-' }}</td>
                                <td>
                                    <div class="blog-actions">
                                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn-icon btn-icon-edit"
                                            title="ویرایش">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                            style="display: inline-block;"
                                            onsubmit="return confirm('آیا از حذف این مقاله اطمینان دارید؟');">
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
                                    <i class="fa-solid fa-inbox"></i> هیچ مقاله‌ای یافت نشد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="blog-pagination">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('blogTable');
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