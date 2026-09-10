@extends('admin.panel')

@section('content')

<style>
    .dashboard {
        padding: 25px;
    }

    .dashboard-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
    }

    .dashboard-title {
        margin: 0;
        font-size: 22px;
        font-weight: 800;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dashboard-title i {
        font-size: 20px;
    }

    .dashboard-subtitle {
        margin: 6px 0 0;
        color: var(--text-dim);
        font-size: 13px;
    }

    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .dashboard-card {
        position: relative;
        overflow: hidden;
        display: block;
        text-decoration: none;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 18px;
        padding: 22px;
        cursor: pointer;
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            border-color .2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-strong);
        border-color: var(--card-color);
    }

    .dashboard-card:active {
        transform: translateY(-1px);
    }

    .dashboard-card::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        right: -35px;
        bottom: -45px;
        background: var(--card-color);
        opacity: .06;
        pointer-events: none;
    }

    .dashboard-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .dashboard-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        background: var(--card-color);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
    }

    .dashboard-card-label {
        margin: 0 0 8px;
        color: var(--text-dim);
        font-size: 14px;
        font-weight: 500;
    }

    .dashboard-card-number {
        margin: 0;
        color: var(--text);
        font-size: 30px;
        line-height: 1;
        font-weight: 800;
    }

    .dashboard-card-projects {
        --card-color: #8b5cf6;
    }

    .dashboard-card-blogs {
        --card-color: #ec4899;
    }

    .dashboard-card-services {
        --card-color: #10b981;
    }

    .dashboard-card-tickets {
        --card-color: #f59e0b;
    }

    @media (max-width: 1100px) {
        .dashboard-cards {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .dashboard {
            padding: 15px;
        }

        .dashboard-header {
            margin-bottom: 18px;
        }

        .dashboard-title {
            font-size: 19px;
        }

        .dashboard-cards {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .dashboard-card {
            padding: 20px;
        }
    }
</style>

<div class="dashboard">

    <div class="dashboard-header">
        <div>
            <h5 class="dashboard-title">
                <i class="fa-solid fa-gauge-high"></i>
                داشبورد
            </h5>

            <p class="dashboard-subtitle">
                نمای کلی اطلاعات سایت
            </p>
        </div>
    </div>

    <div class="dashboard-cards">

        {{-- نمونه کارها --}}
        <a href="{{ route('projects.index') }}"
           class="dashboard-card dashboard-card-projects">

            <div class="dashboard-card-top">
                <div class="dashboard-icon">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
            </div>

            <p class="dashboard-card-label">
                نمونه‌کارها
            </p>

            <h3 class="dashboard-card-number">
                {{ $projectsCount }}
            </h3>
        </a>

        {{-- بلاگ‌ها --}}
        <a href="{{ route('blogs.index') }}"
           class="dashboard-card dashboard-card-blogs">

            <div class="dashboard-card-top">
                <div class="dashboard-icon">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
            </div>

            <p class="dashboard-card-label">
                بلاگ‌ها
            </p>

            <h3 class="dashboard-card-number">
                {{ $blogsCount }}
            </h3>
        </a>

        {{-- خدمات --}}
        <a href="{{ route('pages.index') }}"
           class="dashboard-card dashboard-card-services">

            <div class="dashboard-card-top">
                <div class="dashboard-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
            </div>

            <p class="dashboard-card-label">
                خدمات
            </p>

            <h3 class="dashboard-card-number">
                {{ $servicesCount }}
            </h3>
        </a>

        {{-- تیکت‌ها --}}
        <a href="{{ route('support.index') }}"
           class="dashboard-card dashboard-card-tickets">

            <div class="dashboard-card-top">
                <div class="dashboard-icon">
                    <i class="fa-solid fa-ticket"></i>
                </div>
            </div>

            <p class="dashboard-card-label">
                تیکت‌ها
            </p>

            <h3 class="dashboard-card-number">
                {{ $ticketsCount }}
            </h3>
        </a>

    </div>

</div>

@endsection