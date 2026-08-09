@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-chart-bar"></i> مدیریت فروش
            </h5>
            <a href="{{ route('sales.create') }}" class="btn btn-sm btn-primary" style="padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                <i class="fa-solid fa-plus"></i> افزودن محصول جدید
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
                        <th style="padding: 12px; text-align: right;">تصویر</th>
                        <th style="padding: 12px; text-align: right;">عنوان</th>
                        <th style="padding: 12px; text-align: right;">قیمت</th>
                        <th style="padding: 12px; text-align: right;">شماره</th>
                        <th style="padding: 12px; text-align: right;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $index => $sale)
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 12px;">{{ $sales->firstItem() + $index }}</td>
                            <td style="padding: 12px;">
                                @if($sale->image_url)
                                    <img src="{{ asset('storage/' . $sale->image_url) }}" alt="{{ $sale->title }}" style="width: 45px; height: 45px; object-fit: cover; border-radius: 6px;">
                                @else
                                    <span style="color: var(--text-light);">بدون تصویر</span>
                                @endif
                            </td>
                            <td style="padding: 12px;">{{ $sale->title }}</td>
                            <td style="padding: 12px;">{{ $sale->price ? number_format($sale->price) . ' تومان' : '-' }}</td>
                            <td style="padding: 12px;">{{ $sale->number ?? '-' }}</td>
                            <td style="padding: 12px;">
                                <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-warning" style="margin-left: 5px; display: inline-block; padding: 6px 10px; border-radius: 6px; text-decoration: none;">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('آیا از حذف این محصول اطمینان دارید؟');">
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
                                <i class="fa-solid fa-inbox"></i> هیچ محصولی یافت نشد
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $sales->links() }}
        </div>
    </div>
</div>
@endsection
