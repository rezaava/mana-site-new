@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <h5 style="margin-bottom: 20px;">
        <i class="fa-solid fa-gauge-high"></i> داشبورد
    </h5>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px;">
        <!-- نظرات -->
        <div style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 22px; position: relative; overflow: hidden;">
            <div style="width: 45px; height: 45px; border-radius: 12px; background: linear-gradient(135deg, #6366f1, #8b5cf6); display: flex; align-items: center; justify-content: center; margin-bottom: 15px; color: white; font-size: 20px;">
                <i class="fa-solid fa-comments"></i>
            </div>
            <h3 style="font-size: 28px; margin: 5px 0; font-weight: 800;">
                {{ persianNum(\App\Models\Comments::where('is_approved', true)->count()) }}
            </h3>
            <span style="color: var(--text-dim); font-size: 14px;">نظرات تایید شده</span>
        </div>

        <!-- کاربران -->
        <div style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 22px; position: relative; overflow: hidden;">
            <div style="width: 45px; height: 45px; border-radius: 12px; background: linear-gradient(135deg, #10b981, #34d399); display: flex; align-items: center; justify-content: center; margin-bottom: 15px; color: white; font-size: 20px;">
                <i class="fa-solid fa-users"></i>
            </div>
            <h3 style="font-size: 28px; margin: 5px 0; font-weight: 800;">
                {{ persianNum(\App\Models\User::count()) }}
            </h3>
            <span style="color: var(--text-dim); font-size: 14px;">کل کاربران</span>
        </div>

        <!-- فروش -->
        <div style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 22px; position: relative; overflow: hidden;">
            <div style="width: 45px; height: 45px; border-radius: 12px; background: linear-gradient(135deg, #f59e0b, #fbbf24); display: flex; align-items: center; justify-content: center; margin-bottom: 15px; color: white; font-size: 20px;">
                <i class="fa-solid fa-chart-bar"></i>
            </div>
            <h3 style="font-size: 28px; margin: 5px 0; font-weight: 800;">
                {{ persianNum(\App\Models\Sale::count()) }}
            </h3>
            <span style="color: var(--text-dim); font-size: 14px;">محصولات فروش</span>
        </div>

        <!-- پروژه‌ها -->
        <div style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 22px; position: relative; overflow: hidden;">
            <div style="width: 45px; height: 45px; border-radius: 12px; background: linear-gradient(135deg, #8b5cf6, #a78bfa); display: flex; align-items: center; justify-content: center; margin-bottom: 15px; color: white; font-size: 20px;">
                <i class="fa-solid fa-diagram-project"></i>
            </div>
            <h3 style="font-size: 28px; margin: 5px 0; font-weight: 800;">
                {{ persianNum(\App\Models\Projects::count()) }}
            </h3>
            <span style="color: var(--text-dim); font-size: 14px;">پروژه‌ها</span>
        </div>

        <!-- مقالات -->
        <div style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 22px; position: relative; overflow: hidden;">
            <div style="width: 45px; height: 45px; border-radius: 12px; background: linear-gradient(135deg, #ec4899, #f472b6); display: flex; align-items: center; justify-content: center; margin-bottom: 15px; color: white; font-size: 20px;">
                <i class="fa-solid fa-newspaper"></i>
            </div>
            <h3 style="font-size: 28px; margin: 5px 0; font-weight: 800;">
                {{ persianNum(\App\Models\Blogs::count()) }}
            </h3>
            <span style="color: var(--text-dim); font-size: 14px;">مقالات</span>
        </div>
    </div>
</div>
@endsection
