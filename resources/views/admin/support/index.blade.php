@extends('admin.panel')

@section('content')
    <style>
        .support-page {
            padding: 24px;
            direction: rtl;
        }

        .support-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
        }

        .support-header {
            padding: 20px 24px;
            border-bottom: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .support-title {
            display: flex;
            align-items: center;
            gap: 11px;
            margin: 0;
            color: var(--text);
            font-size: 18px;
            font-weight: 800;
        }

        .support-title-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(59, 130, 246, .12);
            color: #3b82f6;
        }

        .open-count {
            min-width: 27px;
            height: 27px;
            padding: 0 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: #ef4444;
            color: white;
            font-size: 12px;
            font-weight: 700;
        }

        .success-alert {
            margin: 18px 24px 0;
            padding: 12px 15px;
            border: 1px solid rgba(16, 185, 129, .35);
            border-radius: 9px;
            background: rgba(16, 185, 129, .09);
            color: #10b981;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .support-table-wrapper {
            overflow-x: auto;
        }

        .support-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .support-table thead {
            background: rgba(127, 127, 127, .07);
        }

        .support-table th {
            padding: 15px 18px;
            color: var(--text-light);
            font-size: 12px;
            font-weight: 800;
            text-align: right;
            border-bottom: 2px solid var(--border);
            white-space: nowrap;
        }

        .support-table td {
            padding: 15px 18px;
            color: var(--text);
            font-size: 13px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .support-table tbody tr:last-child td {
            border-bottom: none;
        }

        .support-table tbody tr {
            transition: background .2s ease;
        }

        .support-table tbody tr:hover {
            background: rgba(59, 130, 246, .025);
        }

        .ticket-number {
            width: 32px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: rgba(127, 127, 127, .1);
            color: var(--text-light);
            font-size: 11px;
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
            background: rgba(139, 92, 246, .12);
            color: #8b5cf6;
        }

        .user-name {
            color: var(--text);
            font-weight: 700;
            margin-bottom: 3px;
        }

        .user-email {
            color: var(--text-light);
            font-size: 11px;
        }

        .ticket-subject {
            max-width: 280px;
            color: var(--text);
            font-weight: 600;
        }

        .ticket-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .ticket-status::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .ticket-status.open {
            background: rgba(16, 185, 129, .12);
            color: #10b981;
        }

        .ticket-status.open::before {
            background: #10b981;
        }

        .ticket-status.closed {
            background: rgba(107, 114, 128, .12);
            color: #6b7280;
        }

        .ticket-status.closed::before {
            background: #6b7280;
        }

        .ticket-date {
            color: var(--text-light);
            font-size: 12px;
            white-space: nowrap;
        }

        .ticket-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ticket-action {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            transition: all .2s ease;
        }

        .ticket-action.view {
            background: rgba(59, 130, 246, .1);
            color: #3b82f6;
        }

        .ticket-action.view:hover {
            background: #3b82f6;
            color: white;
        }

        .ticket-action.close {
            background: rgba(245, 158, 11, .1);
            color: #f59e0b;
        }

        .ticket-action.close:hover {
            background: #f59e0b;
            color: white;
        }

        .ticket-action.delete {
            background: rgba(239, 68, 68, .1);
            color: #ef4444;
        }

        .ticket-action.delete:hover {
            background: #ef4444;
            color: white;
        }

        .empty-tickets {
            text-align: center;
            padding: 65px 20px !important;
            color: var(--text-light);
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: rgba(127, 127, 127, .08);
            font-size: 25px;
        }

        .empty-tickets strong {
            display: block;
            color: var(--text);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .empty-tickets span {
            font-size: 12px;
        }

        .support-pagination {
            padding: 18px 24px;
            border-top: 2px solid var(--border);
        }

        .support-pagination nav {
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .support-page {
                padding: 15px;
            }

            .support-header {
                padding: 17px;
            }

            .success-alert {
                margin: 15px 17px 0;
            }
        }
    </style>

    <div class="support-page">
        <div class="support-card">

            <div class="support-header">
                <h5 class="support-title">
                    <span class="support-title-icon">
                        <i class="fa-solid fa-headset"></i>
                    </span>

                    تیکت‌های پشتیبانی

                    @if($openCount > 0)
                        <span class="open-count">
                            {{ $openCount }}
                        </span>
                    @endif
                </h5>
            </div>

            @if(session('success'))
                <div class="success-alert">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="support-table-wrapper">
                <table class="support-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>کاربر</th>
                            <th>موضوع</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($tickets as $index => $ticket)
                            <tr>
                                <td>
                                    <span class="ticket-number">
                                        {{ $tickets->firstItem() + $index }}
                                    </span>
                                </td>

                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            <i class="fa-solid fa-user"></i>
                                        </div>

                                        <div>
                                            <div class="user-name">
                                                {{ $ticket->user_name }}
                                            </div>

                                            <div class="user-email">
                                                {{ $ticket->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="ticket-subject">
                                        {{ Str::limit($ticket->subject, 40) }}
                                    </div>
                                </td>

                                <td>
                                    @if($ticket->status === 'open')
                                        <span class="ticket-status open">
                                            باز
                                        </span>
                                    @else
                                        <span class="ticket-status closed">
                                            بسته
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <span class="ticket-date">
                                        <i class="fa-regular fa-calendar" style="margin-left: 5px;"></i>
                                        {{ $ticket->created_at->format('Y/m/d H:i') }}
                                    </span>
                                </td>

                                <td>
                                    <div class="ticket-actions">

                                        <a
                                            href="{{ route('support.show', $ticket->id) }}"
                                            class="ticket-action view"
                                            title="مشاهده"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        @if($ticket->status === 'open')
                                            <a
                                                href="{{ route('support.close', $ticket->id) }}"
                                                class="ticket-action close"
                                                title="بستن"
                                                onclick="return confirm('آیا می‌خواهید این تیکت را ببندید؟');"
                                            >
                                                <i class="fa-solid fa-lock"></i>
                                            </a>
                                        @endif

                                        <form
                                            action="{{ route('support.destroy', $ticket->id) }}"
                                            method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('آیا از حذف این تیکت اطمینان دارید؟');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="ticket-action delete"
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
                                <td colspan="6" class="empty-tickets">
                                    <div class="empty-icon">
                                        <i class="fa-regular fa-envelope-open"></i>
                                    </div>

                                    <strong>هیچ تیکتی وجود ندارد</strong>

                                    <span>
                                        در حال حاضر هیچ درخواست پشتیبانی ثبت نشده است.
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($tickets->hasPages())
                <div class="support-pagination">
                    {{ $tickets->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection