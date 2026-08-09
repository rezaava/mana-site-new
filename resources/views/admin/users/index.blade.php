@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-users"></i> مدیریت کاربران
            </h5>
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary" style="padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                <i class="fa-solid fa-plus"></i> افزودن کاربر جدید
            </a>
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
                        <th style="padding: 12px; text-align: right;">نام</th>
                        <th style="padding: 12px; text-align: right;">ایمیل</th>
                        <th style="padding: 12px; text-align: right;">نقش</th>
                        <th style="padding: 12px; text-align: right;">تاریخ عضویت</th>
                        <th style="padding: 12px; text-align: right;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 12px;">{{ $users->firstItem() + $index }}</td>
                            <td style="padding: 12px;">{{ $user->name }}</td>
                            <td style="padding: 12px;">{{ $user->email }}</td>
                            <td style="padding: 12px;">
                                @if($user->role == 'admin')
                                    <span style="background: #6366f1; color: white; padding: 2px 10px; border-radius: 10px; font-size: 12px;">ادمین</span>
                                @elseif($user->role == 'teacher')
                                    <span style="background: #10b981; color: white; padding: 2px 10px; border-radius: 10px; font-size: 12px;">استاد</span>
                                @else
                                    <span style="background: #f59e0b; color: white; padding: 2px 10px; border-radius: 10px; font-size: 12px;">دانشجو</span>
                                @endif
                            </td>
                            <td style="padding: 12px;">{{ $user->created_at ? $user->created_at->format('Y/m/d') : '-' }}</td>
                            <td style="padding: 12px;">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" style="margin-left: 5px; display: inline-block; padding: 6px 10px; border-radius: 6px; text-decoration: none;">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('آیا از حذف این کاربر اطمینان دارید؟');">
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
                                <i class="fa-solid fa-inbox"></i> هیچ کاربری یافت نشد
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
