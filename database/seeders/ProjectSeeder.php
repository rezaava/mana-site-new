<?php

namespace Database\Seeders;

use App\Models\Projects;
use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = [
            'سلامت دیجیتال' => Categories::where('name', 'سلامت دیجیتال')->first(),
            'فروشگاه آنلاین' => Categories::where('name', 'فروشگاه آنلاین')->first(),
            'پنل مدیریت' => Categories::where('name', 'پنل مدیریت')->first(),
            'اپلیکیشن بانکی' => Categories::where('name', 'اپلیکیشن بانکی')->first(),
            'آموزش آنلاین' => Categories::where('name', 'آموزش آنلاین')->first(),
        ];

        /*
        |--------------------------------------------------------------------------
        | Projects
        |--------------------------------------------------------------------------
        */

        $projects = [

            // =========================================================
            // Project 1
            // =========================================================

            [
                'title' => 'سامانه نوبت‌دهی پزشکی',
                'subtitle' => 'پلتفرم جامع سلامت دیجیتال',
                'brief' => 'سلامت دیجیتال',
                'desc' => 'سامانه‌ای جامع برای نوبت‌دهی آنلاین، مدیریت پرونده الکترونیک بیماران و مشاوره آنلاین با پزشکان که امکان مدیریت پزشکان، بیماران، نوبت‌ها و خدمات درمانی را فراهم می‌کند.',
                'project_goal' => 'هدف پروژه ایجاد یک پلتفرم سریع و قابل اعتماد برای ارتباط بیماران و پزشکان و ساده‌سازی فرآیند دریافت خدمات پزشکی بود.',
                'challenge' => 'مدیریت حجم بالای درخواست‌ها، حفظ امنیت اطلاعات بیماران، جلوگیری از تداخل زمان نوبت‌ها و ایجاد تجربه کاربری ساده برای کاربران با سنین مختلف.',
                'solution' => 'با طراحی معماری مقیاس‌پذیر، سیستم مدیریت نوبت، صف‌بندی درخواست‌ها، احراز هویت امن و طراحی رابط کاربری ساده، مشکلات اصلی برطرف شد.',
                'client_name' => 'مجموعه سلامت نوین',
                'client_role' => 'مدیرعامل',
                'launch_year' => '۱۴۰۲',
                'duration' => '۸ ماه',
                'project_link' => 'https://example.com/medical',
                'testimonial' => 'این سامانه باعث شد فرآیند نوبت‌دهی و ارتباط با بیماران بسیار سریع‌تر و منظم‌تر شود.',
                'number' => 1,
                'cat_id' => $categories['سلامت دیجیتال']->id ?? null,
                'image_url' => 'projects/project1.jpg',
            ],

            // =========================================================
            // Project 2
            // =========================================================

            [
                'title' => 'پلتفرم تجارت الکترونیک',
                'subtitle' => 'فروشگاه آنلاین سریع و مقیاس‌پذیر',
                'brief' => 'فروشگاه آنلاین',
                'desc' => 'فروشگاهی مدرن و مقیاس‌پذیر با تجربه خرید یکپارچه در وب و موبایل، مدیریت محصولات، سفارش‌ها، مشتریان، پرداخت‌ها و موجودی انبار.',
                'project_goal' => 'ایجاد یک فروشگاه آنلاین مدرن با قابلیت مدیریت هزاران محصول و ارائه تجربه خرید سریع، ساده و قابل اعتماد.',
                'challenge' => 'سرعت پایین سیستم قبلی، تعداد زیاد محصولات، مدیریت همزمان سفارش‌ها و نیاز به اتصال پایدار به سیستم پرداخت و انبار.',
                'solution' => 'سیستم با معماری ماژولار، کشینگ، بهینه‌سازی دیتابیس، API و رابط کاربری واکنش‌گرا توسعه داده شد.',
                'client_name' => 'فروشگاه بهین',
                'client_role' => 'مدیر کسب‌وکار',
                'launch_year' => '۱۴۰۳',
                'duration' => '۱۰ ماه',
                'project_link' => 'https://example.com/shop',
                'testimonial' => 'بعد از راه‌اندازی نسخه جدید، سرعت سایت و رضایت کاربران به شکل محسوسی افزایش پیدا کرد.',
                'number' => 2,
                'cat_id' => $categories['فروشگاه آنلاین']->id ?? null,
                'image_url' => 'projects/project2.jpg',
            ],

            // =========================================================
            // Project 3
            // =========================================================

            [
                'title' => 'داشبورد هوشمند فروش',
                'subtitle' => 'مرکز تحلیل و مدیریت فروش',
                'brief' => 'پنل مدیریت',
                'desc' => 'داشبوردی تحلیلی برای رصد لحظه‌ای فروش، موجودی، عملکرد تیم و رفتار مشتریان با گزارش‌های هوشمند و نمودارهای تعاملی.',
                'project_goal' => 'ایجاد یک مرکز کنترل برای مدیران جهت مشاهده سریع اطلاعات مهم کسب‌وکار و تصمیم‌گیری بر اساس داده‌های واقعی.',
                'challenge' => 'پردازش حجم بالای داده و نمایش اطلاعات پیچیده به صورت ساده و قابل فهم برای مدیران و تیم فروش.',
                'solution' => 'داده‌ها با ساختار بهینه پردازش شدند و داشبوردی با نمودارهای تعاملی، فیلترهای پیشرفته و گزارش‌های لحظه‌ای طراحی شد.',
                'client_name' => 'گروه تجاری آریا',
                'client_role' => 'مدیر فروش',
                'launch_year' => '۱۴۰۳',
                'duration' => '۶ ماه',
                'project_link' => 'https://example.com/dashboard',
                'testimonial' => 'اکنون مدیران ما می‌توانند در چند ثانیه وضعیت فروش را بررسی و تصمیم‌گیری کنند.',
                'number' => 3,
                'cat_id' => $categories['پنل مدیریت']->id ?? null,
                'image_url' => 'projects/project3.jpg',
            ],

            // =========================================================
            // Project 4
            // =========================================================

            [
                'title' => 'اپلیکیشن موبایل بانکداری نوین',
                'subtitle' => 'بانکداری دیجیتال در موبایل',
                'brief' => 'اپلیکیشن بانکی',
                'desc' => 'اپلیکیشن بانکی امن با احراز هویت بیومتریک، مدیریت حساب‌ها، انتقال وجه، پرداخت قبوض و مشاهده تراکنش‌ها.',
                'project_goal' => 'ارائه خدمات بانکی روزمره در قالب یک اپلیکیشن سریع، امن و ساده برای کاربران.',
                'challenge' => 'امنیت بالای تراکنش‌ها، احراز هویت کاربران، حفظ سرعت برنامه و ایجاد تجربه کاربری ساده برای عملیات بانکی.',
                'solution' => 'از احراز هویت چندمرحله‌ای، رمزنگاری اطلاعات، ارتباط امن API و معماری بهینه برای اپلیکیشن استفاده شد.',
                'client_name' => 'بانک نوین',
                'client_role' => 'مدیر فناوری اطلاعات',
                'launch_year' => '۱۴۰۲',
                'duration' => '۱۲ ماه',
                'project_link' => 'https://example.com/bank',
                'testimonial' => 'تجربه کاربری جدید باعث شد کاربران بتوانند خدمات بانکی را بسیار سریع‌تر انجام دهند.',
                'number' => 4,
                'cat_id' => $categories['اپلیکیشن بانکی']->id ?? null,
                'image_url' => 'projects/project4.jpg',
            ],

            // =========================================================
            // Project 5
            // =========================================================

            [
                'title' => 'پلتفرم یادگیری هوشمند',
                'subtitle' => 'آموزش آنلاین شخصی‌سازی‌شده',
                'brief' => 'آموزش آنلاین',
                'desc' => 'سامانه آموزش آنلاین با مسیرهای یادگیری شخصی‌سازی‌شده توسط هوش مصنوعی و سیستم ارزیابی عملکرد دانش‌آموزان.',
                'project_goal' => 'ایجاد یک محیط آموزشی هوشمند که بتواند مسیر یادگیری هر کاربر را بر اساس عملکرد و نیازهای او تنظیم کند.',
                'challenge' => 'طراحی الگوریتم شخصی‌سازی آموزش و هماهنگ کردن محتوای آموزشی، آزمون‌ها، تمرین‌ها و گزارش‌های عملکرد.',
                'solution' => 'سیستم پیشنهاد محتوا و تحلیل عملکرد کاربران با استفاده از داده‌های آموزشی و الگوریتم‌های هوشمند طراحی شد.',
                'client_name' => 'آکادمی دانش',
                'client_role' => 'مدیر آموزش',
                'launch_year' => '۱۴۰۳',
                'duration' => '۹ ماه',
                'project_link' => 'https://example.com/academy',
                'testimonial' => 'سیستم شخصی‌سازی باعث شد دانش‌آموزان مسیر آموزشی متناسب با سطح خودشان داشته باشند.',
                'number' => 5,
                'cat_id' => $categories['آموزش آنلاین']->id ?? null,
                'image_url' => 'projects/project5.jpg',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Create Projects
        |--------------------------------------------------------------------------
        */

        foreach ($projects as $projectData) {

            $project = Projects::create($projectData);

            /*
            |--------------------------------------------------------------------------
            | Project Services
            |--------------------------------------------------------------------------
            */

            $services = [];

            if ($project->number == 1) {

                $services = [
                    [
                        'name' => 'طراحی UX/UI',
                        'icon' => 'fa-palette',
                        'order' => 1,
                    ],
                    [
                        'name' => 'توسعه وب',
                        'icon' => 'fa-code',
                        'order' => 2,
                    ],
                    [
                        'name' => 'طراحی API',
                        'icon' => 'fa-plug',
                        'order' => 3,
                    ],
                ];
            }

            if ($project->number == 2) {

                $services = [
                    [
                        'name' => 'طراحی فروشگاه',
                        'icon' => 'fa-cart-shopping',
                        'order' => 1,
                    ],
                    [
                        'name' => 'توسعه Backend',
                        'icon' => 'fa-server',
                        'order' => 2,
                    ],
                    [
                        'name' => 'توسعه Frontend',
                        'icon' => 'fa-code',
                        'order' => 3,
                    ],
                ];
            }

            if ($project->number == 3) {

                $services = [
                    [
                        'name' => 'طراحی داشبورد',
                        'icon' => 'fa-chart-line',
                        'order' => 1,
                    ],
                    [
                        'name' => 'تحلیل داده',
                        'icon' => 'fa-chart-pie',
                        'order' => 2,
                    ],
                    [
                        'name' => 'گزارش‌گیری هوشمند',
                        'icon' => 'fa-file-chart-column',
                        'order' => 3,
                    ],
                ];
            }

            if ($project->number == 4) {

                $services = [
                    [
                        'name' => 'طراحی اپلیکیشن',
                        'icon' => 'fa-mobile-screen',
                        'order' => 1,
                    ],
                    [
                        'name' => 'توسعه موبایل',
                        'icon' => 'fa-code',
                        'order' => 2,
                    ],
                    [
                        'name' => 'امنیت اپلیکیشن',
                        'icon' => 'fa-shield-halved',
                        'order' => 3,
                    ],
                ];
            }

            if ($project->number == 5) {

                $services = [
                    [
                        'name' => 'طراحی پلتفرم آموزشی',
                        'icon' => 'fa-graduation-cap',
                        'order' => 1,
                    ],
                    [
                        'name' => 'هوش مصنوعی',
                        'icon' => 'fa-brain',
                        'order' => 2,
                    ],
                    [
                        'name' => 'تحلیل عملکرد کاربران',
                        'icon' => 'fa-chart-line',
                        'order' => 3,
                    ],
                ];
            }

            foreach ($services as $service) {

                DB::table('project_services')->insert([
                    'project_id' => $project->id,
                    'name' => $service['name'],
                    'icon' => $service['icon'],
                    'order' => $service['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Project Stats
            |--------------------------------------------------------------------------
            | دقیقاً ۴ استات برای هر پروژه
            |--------------------------------------------------------------------------
            */

            $stats = [];

            if ($project->number == 1) {

                $stats = [
                    [
                        'value' => '65%',
                        'label' => 'کاهش زمان نوبت‌دهی',
                    ],
                    [
                        'value' => '3x',
                        'label' => 'افزایش کاربران',
                    ],
                    [
                        'value' => '98%',
                        'label' => 'رضایت کاربران',
                    ],
                    [
                        'value' => '40%',
                        'label' => 'کاهش خطاها',
                    ],
                ];
            }

            if ($project->number == 2) {

                $stats = [
                    [
                        'value' => '45%',
                        'label' => 'افزایش نرخ تبدیل',
                    ],
                    [
                        'value' => '2.5x',
                        'label' => 'افزایش فروش',
                    ],
                    [
                        'value' => '70%',
                        'label' => 'افزایش سرعت',
                    ],
                    [
                        'value' => '35%',
                        'label' => 'کاهش نرخ خروج',
                    ],
                ];
            }

            if ($project->number == 3) {

                $stats = [
                    [
                        'value' => '40%',
                        'label' => 'کاهش زمان گزارش‌گیری',
                    ],
                    [
                        'value' => '3x',
                        'label' => 'افزایش بهره‌وری',
                    ],
                    [
                        'value' => '95%',
                        'label' => 'دقت گزارش‌ها',
                    ],
                    [
                        'value' => '50%',
                        'label' => 'کاهش زمان تصمیم‌گیری',
                    ],
                ];
            }

            if ($project->number == 4) {

                $stats = [
                    [
                        'value' => '60%',
                        'label' => 'کاهش زمان عملیات',
                    ],
                    [
                        'value' => '4x',
                        'label' => 'افزایش کاربران فعال',
                    ],
                    [
                        'value' => '99.9%',
                        'label' => 'پایداری سرویس',
                    ],
                    [
                        'value' => '85%',
                        'label' => 'رضایت کاربران',
                    ],
                ];
            }

            if ($project->number == 5) {

                $stats = [
                    [
                        'value' => '55%',
                        'label' => 'افزایش مشارکت',
                    ],
                    [
                        'value' => '2x',
                        'label' => 'بهبود یادگیری',
                    ],
                    [
                        'value' => '92%',
                        'label' => 'رضایت کاربران',
                    ],
                    [
                        'value' => '45%',
                        'label' => 'افزایش تکمیل دوره',
                    ],
                ];
            }

            foreach ($stats as $stat) {

                DB::table('project_stats')->insert([
                    'project_id' => $project->id,
                    'value' => $stat['value'],
                    'label' => $stat['label'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Project Technologies
            |--------------------------------------------------------------------------
            */

            $technologies = [];

            if ($project->number == 1) {

                $technologies = [
                    [
                        'name' => 'Laravel',
                        'icon' => 'fa-laravel',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Vue.js',
                        'icon' => 'fa-vuejs',
                        'order' => 2,
                    ],
                    [
                        'name' => 'MySQL',
                        'icon' => 'fa-database',
                        'order' => 3,
                    ],
                    [
                        'name' => 'Redis',
                        'icon' => 'fa-server',
                        'order' => 4,
                    ],
                ];
            }

            if ($project->number == 2) {

                $technologies = [
                    [
                        'name' => 'Laravel',
                        'icon' => 'fa-laravel',
                        'order' => 1,
                    ],
                    [
                        'name' => 'React',
                        'icon' => 'fa-react',
                        'order' => 2,
                    ],
                    [
                        'name' => 'MySQL',
                        'icon' => 'fa-database',
                        'order' => 3,
                    ],
                    [
                        'name' => 'Redis',
                        'icon' => 'fa-server',
                        'order' => 4,
                    ],
                ];
            }

            if ($project->number == 3) {

                $technologies = [
                    [
                        'name' => 'Laravel',
                        'icon' => 'fa-laravel',
                        'order' => 1,
                    ],
                    [
                        'name' => 'React',
                        'icon' => 'fa-react',
                        'order' => 2,
                    ],
                    [
                        'name' => 'Chart.js',
                        'icon' => 'fa-chart-line',
                        'order' => 3,
                    ],
                    [
                        'name' => 'MySQL',
                        'icon' => 'fa-database',
                        'order' => 4,
                    ],
                ];
            }

            if ($project->number == 4) {

                $technologies = [
                    [
                        'name' => 'Flutter',
                        'icon' => 'fa-mobile-screen',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Laravel',
                        'icon' => 'fa-laravel',
                        'order' => 2,
                    ],
                    [
                        'name' => 'MySQL',
                        'icon' => 'fa-database',
                        'order' => 3,
                    ],
                    [
                        'name' => 'Firebase',
                        'icon' => 'fa-fire',
                        'order' => 4,
                    ],
                ];
            }

            if ($project->number == 5) {

                $technologies = [
                    [
                        'name' => 'Laravel',
                        'icon' => 'fa-laravel',
                        'order' => 1,
                    ],
                    [
                        'name' => 'React',
                        'icon' => 'fa-react',
                        'order' => 2,
                    ],
                    [
                        'name' => 'Python',
                        'icon' => 'fa-python',
                        'order' => 3,
                    ],
                    [
                        'name' => 'OpenAI',
                        'icon' => 'fa-brain',
                        'order' => 4,
                    ],
                ];
            }

            foreach ($technologies as $technology) {

                DB::table('project_technologies')->insert([
                    'project_id' => $project->id,
                    'name' => $technology['name'],
                    'icon' => $technology['icon'],
                    'order' => $technology['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Project Features
            |--------------------------------------------------------------------------
            | دقیقاً ۴ امکان برای هر پروژه
            |--------------------------------------------------------------------------
            */

            $features = [];

            if ($project->number == 1) {

                $features = [
                    [
                        'icon' => 'fa-calendar-check',
                        'title' => 'نوبت‌دهی هوشمند',
                        'text' => 'سیستم هوشمند مدیریت نوبت‌ها از تداخل زمان‌ها جلوگیری کرده و فرآیند رزرو را ساده می‌کند.',
                    ],
                    [
                        'icon' => 'fa-user-doctor',
                        'title' => 'مدیریت پزشکان',
                        'text' => 'پزشکان می‌توانند برنامه کاری، زمان‌های آزاد و اطلاعات بیماران خود را مدیریت کنند.',
                    ],
                    [
                        'icon' => 'fa-shield-halved',
                        'title' => 'امنیت اطلاعات',
                        'text' => 'اطلاعات کاربران و پرونده‌های پزشکی با استفاده از روش‌های امن ذخیره و منتقل می‌شوند.',
                    ],
                    [
                        'icon' => 'fa-comments',
                        'title' => 'مشاوره آنلاین',
                        'text' => 'کاربران امکان ارتباط آنلاین با پزشکان و دریافت مشاوره پزشکی را دارند.',
                    ],
                ];
            }

            if ($project->number == 2) {

                $features = [
                    [
                        'icon' => 'fa-cart-shopping',
                        'title' => 'خرید آنلاین',
                        'text' => 'کاربران می‌توانند محصولات را مشاهده، مقایسه و به صورت آنلاین خریداری کنند.',
                    ],
                    [
                        'icon' => 'fa-credit-card',
                        'title' => 'پرداخت آنلاین',
                        'text' => 'سیستم پرداخت امن برای انجام سریع و مطمئن تراکنش‌های کاربران طراحی شده است.',
                    ],
                    [
                        'icon' => 'fa-boxes-stacked',
                        'title' => 'مدیریت موجودی',
                        'text' => 'موجودی محصولات به صورت دقیق مدیریت و وضعیت کالاها به‌روزرسانی می‌شود.',
                    ],
                    [
                        'icon' => 'fa-truck-fast',
                        'title' => 'مدیریت سفارش',
                        'text' => 'تمام مراحل ثبت، پردازش و ارسال سفارش‌ها از طریق پنل مدیریت قابل کنترل است.',
                    ],
                ];
            }

            if ($project->number == 3) {

                $features = [
                    [
                        'icon' => 'fa-chart-line',
                        'title' => 'گزارش‌های لحظه‌ای',
                        'text' => 'مدیران می‌توانند اطلاعات فروش و عملکرد کسب‌وکار را به صورت لحظه‌ای مشاهده کنند.',
                    ],
                    [
                        'icon' => 'fa-filter',
                        'title' => 'فیلترهای پیشرفته',
                        'text' => 'امکان فیلتر اطلاعات بر اساس تاریخ، محصول، کاربر و سایر معیارهای مدیریتی وجود دارد.',
                    ],
                    [
                        'icon' => 'fa-chart-pie',
                        'title' => 'تحلیل داده',
                        'text' => 'داده‌های کسب‌وکار به صورت نمودارها و گزارش‌های قابل فهم نمایش داده می‌شوند.',
                    ],
                    [
                        'icon' => 'fa-gauge-high',
                        'title' => 'نمایش عملکرد',
                        'text' => 'شاخص‌های مهم عملکرد در یک داشبورد مرکزی و ساده در اختیار مدیران قرار می‌گیرد.',
                    ],
                ];
            }

            if ($project->number == 4) {

                $features = [
                    [
                        'icon' => 'fa-fingerprint',
                        'title' => 'احراز هویت بیومتریک',
                        'text' => 'کاربران می‌توانند برای دسترسی سریع و امن از احراز هویت بیومتریک استفاده کنند.',
                    ],
                    [
                        'icon' => 'fa-money-bill-transfer',
                        'title' => 'انتقال وجه',
                        'text' => 'انتقال وجه و انجام تراکنش‌های بانکی با سرعت و امنیت بالا انجام می‌شود.',
                    ],
                    [
                        'icon' => 'fa-shield-halved',
                        'title' => 'امنیت چندلایه',
                        'text' => 'اطلاعات حساس و تراکنش‌های مالی با استفاده از چندین لایه امنیتی محافظت می‌شوند.',
                    ],
                    [
                        'icon' => 'fa-receipt',
                        'title' => 'مدیریت تراکنش‌ها',
                        'text' => 'کاربران می‌توانند تمام تراکنش‌ها و سوابق مالی خود را مشاهده و مدیریت کنند.',
                    ],
                ];
            }

            if ($project->number == 5) {

                $features = [
                    [
                        'icon' => 'fa-brain',
                        'title' => 'یادگیری هوشمند',
                        'text' => 'مسیر آموزشی کاربران بر اساس عملکرد و سطح یادگیری آن‌ها شخصی‌سازی می‌شود.',
                    ],
                    [
                        'icon' => 'fa-route',
                        'title' => 'مسیر یادگیری',
                        'text' => 'برای هر کاربر مسیر آموزشی متناسب با نیازها و اهداف او ایجاد می‌شود.',
                    ],
                    [
                        'icon' => 'fa-chart-line',
                        'title' => 'تحلیل عملکرد',
                        'text' => 'عملکرد کاربران در دوره‌ها، آزمون‌ها و تمرین‌ها به صورت دقیق تحلیل می‌شود.',
                    ],
                    [
                        'icon' => 'fa-graduation-cap',
                        'title' => 'ارزیابی آموزشی',
                        'text' => 'سیستم ارزیابی میزان پیشرفت کاربران را بررسی کرده و نقاط ضعف آن‌ها را مشخص می‌کند.',
                    ],
                ];
            }

            foreach ($features as $feature) {

                DB::table('project_features')->insert([
                    'project_id' => $project->id,
                    'icon' => $feature['icon'],
                    'title' => $feature['title'],
                    'text' => $feature['text'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Project Gallery
            |--------------------------------------------------------------------------
            */

            $gallery = [

                [
                    'category' => 'desktop',
                    'image_url' => 'projects/project' . $project->number . '-desktop-1.jpg',
                ],

                [
                    'category' => 'desktop',
                    'image_url' => 'projects/project' . $project->number . '-desktop-2.jpg',
                ],

                [
                    'category' => 'mobile',
                    'image_url' => 'projects/project' . $project->number . '-mobile-1.jpg',
                ],

                [
                    'category' => 'mobile',
                    'image_url' => 'projects/project' . $project->number . '-mobile-2.jpg',
                ],

                [
                    'category' => 'key_pages',
                    'image_url' => 'projects/project' . $project->number . '-key-1.jpg',
                ],

                [
                    'category' => 'key_pages',
                    'image_url' => 'projects/project' . $project->number . '-key-2.jpg',
                ],
            ];

            foreach ($gallery as $image) {

                DB::table('project_galleries')->insert([
                    'project_id' => $project->id,
                    'category' => $image['category'],
                    'image_url' => $image['image_url'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}