<!-- ============ FOOTER ============ -->
<footer class="site-footer">
    <div class="footer-inner">
        <div class="container-x">
            <div class="footer-island reveal">
                <div class="dots"></div>
                <div class="footer-newsletter">
                    <div class="fn-text">
                        <div class="fn-ic">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                        <div>
                            <strong>
                                {{ $siteTexts['newsletter_title']->value ?? 'از آخرین اخبار و تخفیف‌ها باخبر شوید!' }}
                            </strong>

                            <span class="sub">
                                {{ $siteTexts['newsletter_sub']->value ?? 'هر هفته یک ایمیل، بدون اسپم' }}
                            </span>
                        </div>

                    </div>

                    <form onsubmit="return false;">

                        <input type="email" placeholder="آدرس ایمیل شما...">

                        <button type="submit">
                            ارسال
                        </button>

                    </form>

                </div>


                <div class="footer-3col">


                    {{-- لینک‌های سریع --}}

                    <div class="footer-col">

                        <h5>
                            {{ $siteTexts['footer_links']->value ?? 'لینک‌های سریع' }}
                        </h5>

                        <ul>

                            <li>
                                <a href="#home">
                                    <i class="fa-solid fa-caret-left"></i>
                                    {{ $siteTexts['nav_home']->value ?? 'خانه' }}
                                </a>
                            </li>

                            <li>
                                <a href="#folio">
                                    <i class="fa-solid fa-caret-left"></i>
                                    {{ $siteTexts['folio_badge']->value ?? 'نمونه‌کارها' }}
                                </a>
                            </li>

                            <li>
                                <a href="#team">
                                    <i class="fa-solid fa-caret-left"></i>
                                    {{ $siteTexts['team_badge']->value ?? 'تیم ما' }}
                                </a>
                            </li>

                            <li>
                                <a href="#contact">
                                    <i class="fa-solid fa-caret-left"></i>
                                    {{ $siteTexts['contact_badge']->value ?? 'تماس با ما' }}
                                </a>
                            </li>

                            <li>
                                <a href="#blog">
                                    <i class="fa-solid fa-caret-left"></i>
                                    {{ $siteTexts['blog_nav']->value ?? 'وبلاگ' }}
                                </a>
                            </li>

                        </ul>

                    </div>


                    {{-- برند --}}

                    <div class="footer-col footer-center">

                        <a href="#home" class="footer-brand">
                            {{ $siteTexts['footer_brand']->value ?? 'مانا' }}
                        </a>

                        <p class="footer-tag">
                            {{ $siteTexts['footer_tag']->value ?? 'ارائه‌ی راهکارهای هوشمند دیجیتال؛ از ایده تا اجرا، همراه کسب‌وکار شما برای ساختن آینده‌ای دیجیتال.' }}
                        </p>

                        <div class="footer-social">

                            @foreach ($socials as $social)

                                <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands {{ $social->icon_class }}"></i>
                                </a>

                            @endforeach

                        </div>
                    </div>


                    {{-- خدمات --}}

                    <div class="footer-col">
                        <h5>
                            {{ $siteTexts['footer_services']->value ?? 'خدمات' }}
                        </h5>

                        <ul>
                            @foreach ($services->take(4) as $service)
                                <li>
                                    <a href="#services">
                                        <i class="fa-solid fa-caret-left"></i>
                                        {{ $service->title }}
                                    </a>
                                </li>
                            @endforeach

                            <li>
                                <a href="tel:02117545678">
                                    <i class="fa-solid fa-phone"></i>
                                    ۰۲۱-۱۷۵۴۵۶۷۸
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>


                {{-- Badges --}}

                <div class="footer-badges">

                    <div class="fb-item">
                        <i class="fa-solid fa-shield-halved"></i>
                        {{ $siteTexts['badge1']->value ?? 'قرارداد و محرمانگی NDA' }}
                    </div>

                    <div class="fb-item">
                        <i class="fa-solid fa-headset"></i>
                        {{ $siteTexts['badge2']->value ?? 'پشتیبانی ۲۴/۷' }}
                    </div>

                    <div class="fb-item">
                        <i class="fa-solid fa-bolt"></i>
                        {{ $siteTexts['badge3']->value ?? 'تحویل به‌موقع پروژه' }}
                    </div>

                    <div class="fb-item">
                        <i class="fa-solid fa-tags"></i>
                        {{ $siteTexts['badge4']->value ?? 'قیمت‌گذاری شفاف' }}
                    </div>

                </div>

            </div>


            {{-- Footer Bottom --}}

            <div class="footer-bottom">

                <p>
                    {{ $siteTexts['copyright']->value ?? '© ۲۰۲۶ مانا. تمامی حقوق محفوظ است.' }}
                </p>

                <div class="legal">
                    <a href="#">
                        حریم خصوصی
                    </a>
                    <a href="#">
                        شرایط استفاده
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>


<button class="to-top" id="toTop">
    <i class="fa-solid fa-arrow-up"></i>
</button>


<a href="#contact" class="chat-fab" id="chatFab">
    <i class="fa-solid fa-comment-dots"></i>
</a>