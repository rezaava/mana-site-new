@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-users"></i> بازدیدکنندگان
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
                        <th style="padding: 12px; text-align: right;">IP</th>
                        <th style="padding: 12px; text-align: right;">کشور</th>
                        <th style="padding: 12px; text-align: right;">منطقه</th>
                        <th style="padding: 12px; text-align: right;">تاریخ بازدید</th>
                        <th style="padding: 12px; text-align: right;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visitors as $index => $visitor)
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 12px;">{{ $visitors->firstItem() + $index }}</td>
                            <td style="padding: 12px;">{{ $visitor->ip_address ?? '-' }}</td>
                            <td style="padding: 12px;">{{ $visitor->country ?? '-' }}</td>
                            <td style="padding: 12px;">{{ $visitor->region ?? '-' }}</td>
                            <td style="padding: 12px;">{{ $visitor->visited_at ? $visitor->visited_at->format('Y/m/d H:i') : '-' }}</td>
                            <td style="padding: 12px;">
                                <form action="{{ route('visitors.destroy', $visitor->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('آیا از حذف این بازدیدکننده اطمینان دارید؟');">
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
                                <i class="fa-solid fa-inbox"></i> هیچ بازدیدکننده‌ای یافت نشد
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $visitors->links() }}
        </div>
    </div>
</div>
@endsection
