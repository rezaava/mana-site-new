@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-headset"></i> تیکت‌های پشتیبانی
                @if($openCount > 0)
                    <span style="background: #ef4444; color: white; padding: 2px 10px; border-radius: 10px; font-size: 13px; margin-right: 8px;">{{ persianNum($openCount) }}</span>
                @endif
            </h5>
        </div>

        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border);">
                        <th style="padding: 12px; text-align: right;">#</th>
                        <th style="padding: 12px; text-align: right;">کاربر</th>
                        <th style="padding: 12px; text-align: right;">موضوع</th>
                        <th style="padding: 12px; text-align: right;">وضعیت</th>
                        <th style="padding: 12px; text-align: right;">تاریخ</th>
                        <th style="padding: 12px; text-align: right;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $index => $ticket)
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 12px;">{{ persianNum($tickets->firstItem() + $index) }}</td>
                            <td style="padding: 12px;">{{ $ticket->user_name }}</td>
                            <td style="padding: 12px;">{{ Str::limit($ticket->subject, 40) }}</td>
                            <td style="padding: 12px;">
                                @if($ticket->status == 'open')
                                    <span style="background: #10b981; color: white; padding: 3px 10px; border-radius: 10px; font-size: 12px;">باز</span>
                                @else
                                    <span style="background: #6b7280; color: white; padding: 3px 10px; border-radius: 10px; font-size: 12px;">بسته</span>
                                @endif
                            </td>
                            <td style="padding: 12px;">{{ $ticket->created_at->format('Y/m/d H:i') }}</td>
                            <td style="padding: 12px;">
                                <a href="{{ route('support.show', $ticket->id) }}" class="btn btn-sm btn-info" style="margin-left: 3px; display: inline-block; padding: 6px 10px; border-radius: 6px; text-decoration: none;">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @if($ticket->status == 'open')
                                    <a href="{{ route('support.close', $ticket->id) }}" class="btn btn-sm btn-warning" style="margin-left: 3px; display: inline-block; padding: 6px 10px; border-radius: 6px; text-decoration: none;" onclick="return confirm('بستن این تیکت؟');">
                                        <i class="fa-solid fa-lock"></i>
                                    </a>
                                @endif
                                <form action="{{ route('support.destroy', $ticket->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('آیا از حذف این تیکت اطمینان دارید؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="padding: 6px 10px; border-radius: 6px; border: none; cursor: pointer;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-light);">
                                <i class="fa-solid fa-inbox"></i> هیچ تیکتی یافت نشد
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $tickets->links() }}
        </div>
    </div>
</div>
@endsection
