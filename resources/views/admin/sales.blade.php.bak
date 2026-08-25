@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <h5 style="margin-bottom: 20px;">
            <i class="fa-solid fa-chart-bar"></i> فروش
        </h5>

        <div id="salesTable">
            <p style="text-align: center; padding: 40px; color: var(--text-light);">
                <i class="fa-solid fa-spinner fa-spin"></i> در حال بارگذاری...
            </p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadQuestions();
});

function loadQuestions() {
    fetch('/admin/questions/questions')
        .then(response => response.json())
        .then(data => {
            let html = `
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border);">
                            <th style="padding: 12px; text-align: right;">#</th>
                            <th style="padding: 12px; text-align: right;">عنوان</th>
                            <th style="padding: 12px; text-align: right;">تعداد</th>
                            <th style="padding: 12px; text-align: right;">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>`;

            if (data && data.length > 0) {
                data.forEach((question, index) => {
                    html += `
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 12px;">${index + 1}</td>
                            <td style="padding: 12px;">${question.title || question.question || 'بدون عنوان'}</td>
                            <td style="padding: 12px;">${question.count || 0}</td>
                            <td style="padding: 12px;">
                                <button class="btn btn-sm btn-warning" style="margin-left: 5px;">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>`;
                });
            } else {
                html += `
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-light);">
                            <i class="fa-solid fa-inbox"></i> هیچ عنوانی یافت نشد
                        </td>
                    </tr>`;
            }

            html += '</tbody></table>';
            document.getElementById('salesTable').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('salesTable').innerHTML = `
                <p style="text-align: center; padding: 40px; color: #ef4444;">
                    <i class="fa-solid fa-exclamation-triangle"></i> خطا در بارگذاری داده‌ها
                </p>`;
        });
}
</script>
@endsection
