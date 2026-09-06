<header class="site-header" id="siteHeader">
    <div class="container-x nav-wrap">

        <a href="#home" class="brand">
            <span class="mark">
                <img src="{{ asset('img/mana.png') }}" alt="">
            </span>
        </a>

        <nav class="main-nav">

            <a href="#home" class="active">
                {{ $siteTexts['nav_home']->value ?? 'خانه' }}
            </a>

            <a href="#services">
                {{ $siteTexts['services_badge']->value ?? 'خدمات' }}
            </a>

            <a href="#folio">
                {{ $siteTexts['folio_badge']->value ?? 'نمونه‌کار' }}
            </a>

            <a href="#team">
                {{ $siteTexts['team_badge']->value ?? 'تیم' }}
            </a>

            <a href="#contact">
                {{ $siteTexts['contact_badge']->value ?? 'تماس' }}
            </a>

            <a href="#blog">
                {{ $siteTexts['blog_nav']->value ?? 'وبلاگ' }}
            </a>

        </nav>

        <div class="header-cta">

            <div class="theme-switch" id="themeSwitch">
                <div class="knob">
                    <i class="fa-solid fa-moon" id="themeIcon"></i>
                </div>
            </div>

            <a href="#contact" class="btn-flow">
                <i class="fa-solid fa-arrow-left"></i>
                {{ $siteTexts['hero_cta']->value ?? 'مشاوره رایگان' }}
            </a>

            <button class="burger" id="burgerBtn">
                <i class="fa-solid fa-bars"></i>
            </button>

        </div>

    </div>
</header>


<div class="mnav-backdrop" id="mnavBackdrop"></div>

<div class="mnav-panel" id="mnavPanel">

    <div class="mnav-handle"></div>

    <div class="top">

        <h6>
            {{ $siteTexts['nav_quick']->value ?? 'منوی سریع' }}
        </h6>

        <button class="burger" id="closeDrawer">
            <i class="fa-solid fa-xmark"></i>
        </button>

    </div>

    <nav>

        <a href="#home" class="active" data-close>
            <i class="fa-solid fa-house"></i>
            {{ $siteTexts['nav_home']->value ?? 'خانه' }}
        </a>

        <a href="#services" data-close>
            <i class="fa-solid fa-layer-group"></i>
            {{ $siteTexts['services_badge']->value ?? 'خدمات' }}
        </a>

        <a href="#folio" data-close>
            <i class="fa-solid fa-briefcase"></i>
            {{ $siteTexts['folio_badge']->value ?? 'نمونه‌کار' }}
        </a>

        <a href="#team" data-close>
            <i class="fa-solid fa-people-group"></i>
            {{ $siteTexts['team_badge']->value ?? 'تیم' }}
        </a>

        <a href="#blog" data-close>
            <i class="fa-solid fa-pen-nib"></i>
            {{ $siteTexts['blog_nav']->value ?? 'وبلاگ' }}
        </a>

        <a href="#contact" data-close>
            <i class="fa-solid fa-phone"></i>
            {{ $siteTexts['contact_badge']->value ?? 'تماس' }}
        </a>

    </nav>

    <div class="foot">

        <div class="theme-switch" id="themeSwitchMobile">
            <div class="knob">
                <i class="fa-solid fa-moon"></i>
            </div>
        </div>

        <a href="#contact" class="btn-flow" data-close>
            {{ $siteTexts['hero_cta']->value ?? 'مشاوره رایگان' }}
            <i class="fa-solid fa-arrow-left"></i>
        </a>

    </div>

</div>