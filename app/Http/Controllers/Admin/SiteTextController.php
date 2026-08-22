<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteText;
use Illuminate\Http\Request;

class SiteTextController extends Controller
{
    public function index()
    {
        $texts = [
            'hero_badge' => ['label' => 'بج بخش قهرمان', 'value' => 'استودیوی محصولات دیجیتال'],
            'hero_title' => ['label' => 'عنوان اصلی قهرمان', 'value' => 'ساختن آینده دیجیتال شما، امروز شروع می‌شود'],
            'hero_desc' => ['label' => 'توضیحات قهرمان', 'value' => 'از ایده تا محصول؛ تیم نوین‌آی با ترکیب هوش مصنوعی، طراحی مدرن و مهندسی دقیق، محصولاتی می‌سازد که کسب‌وکار شما را برای فردا آماده می‌کند.'],
            'hero_trust' => ['label' => 'متن اعتماد', 'value' => 'مورد اعتماد بیش از ۵۰ کسب‌وکار موفق'],
            'stat1_num' => ['label' => 'آمار ۱ - عدد', 'value' => '۲۵۰+'],
            'stat1_text' => ['label' => 'آمار ۱ - متن', 'value' => 'پروژه موفق'],
            'stat2_num' => ['label' => 'آمار ۲ - عدد', 'value' => '۹۸%'],
            'stat2_text' => ['label' => 'آمار ۲ - متن', 'value' => 'رضایت مشتریان'],
            'stat3_num' => ['label' => 'آمار ۳ - عدد', 'value' => '۵۰+'],
            'stat3_text' => ['label' => 'آمار ۳ - متن', 'value' => 'مشتری فعال'],
            'stat4_num' => ['label' => 'آمار ۴ - عدد', 'value' => '۲۴/۷'],
            'stat4_text' => ['label' => 'آمار ۴ - متن', 'value' => 'پشتیبانی'],
            'services_badge' => ['label' => 'بج خدمات', 'value' => 'خدمات ما'],
            'services_title' => ['label' => 'عنوان خدمات', 'value' => 'هر آنچه برای رشد دیجیتال نیاز دارید، اینجاست'],
            'services_sub' => ['label' => 'توضیحات خدمات', 'value' => 'از هوش مصنوعی تا اپلیکیشن موبایل؛ راهکارهایی که بر پایه‌ی داده، طراحی و مهندسی مدرن ساخته شده‌اند.'],
            'why_badge' => ['label' => 'بج چرا مانا', 'value' => 'چرا مانا'],
            'why_title' => ['label' => 'عنوان چرا مانا', 'value' => 'شریکی که رشد دیجیتال شما را جدی می‌گیرد'],
            'why1_title' => ['label' => 'چرا مانا - عنوان ۱', 'value' => 'تیمی متخصص و باتجربه'],
            'why1_desc' => ['label' => 'چرا مانا - توضیح ۱', 'value' => 'متخصصانی با سال‌ها تجربه در پروژه‌های واقعی و پیچیده.'],
            'why2_title' => ['label' => 'چرا مانا - عنوان ۲', 'value' => 'کیفیت تضمین‌شده'],
            'why2_desc' => ['label' => 'چرا مانا - توضیح ۲', 'value' => 'تست و بازبینی دقیق در هر مرحله از توسعه‌ی پروژه.'],
            'why3_title' => ['label' => 'چرا مانا - عنوان ۳', 'value' => 'پشتیبانی ۲۴/۷'],
            'why3_desc' => ['label' => 'چرا مانا - توضیح ۳', 'value' => 'همراهی و پاسخگویی سریع در تمام ساعات شبانه‌روز.'],
            'why4_title' => ['label' => 'چرا مانا - عنوان ۴', 'value' => 'قیمت‌گذاری شفاف'],
            'why4_desc' => ['label' => 'چرا مانا - توضیح ۴', 'value' => 'بدون هزینه‌ی پنهان؛ برآورد دقیق پیش از شروع کار.'],
            'exp_num' => ['label' => 'عدد تجربه', 'value' => '۱۵+'],
            'exp_title' => ['label' => 'عنوان تجربه', 'value' => 'سال تجربه'],
            'exp_desc' => ['label' => 'توضیح تجربه', 'value' => 'در ساخت محصولات دیجیتال'],
            'folio_badge' => ['label' => 'بج نمونه‌کار', 'value' => 'نمونه‌کارها'],
            'folio_title' => ['label' => 'عنوان نمونه‌کار', 'value' => 'بخشی از پروژه‌های موفق ما'],
            'folio_sub' => ['label' => 'توضیح نمونه‌کار', 'value' => 'روی هر مورد کلیک کنید تا جزئیات پروژه را ببینید.'],
            'team_badge' => ['label' => 'بج تیم', 'value' => 'تیم ما'],
            'team_title' => ['label' => 'عنوان تیم', 'value' => 'متخصصانی که ایده شما را می‌سازند'],
            'testi_badge' => ['label' => 'بج نظرات', 'value' => 'نظرات مشتریان'],
            'testi_title' => ['label' => 'عنوان نظرات', 'value' => 'آنچه مشتریان ما می‌گویند'],
            'faq_badge' => ['label' => 'بج سوالات', 'value' => 'سوالات متداول'],
            'faq_title' => ['label' => 'عنوان سوالات', 'value' => 'پاسخ سوالات رایج شما'],
            'contact_badge' => ['label' => 'بج تماس', 'value' => 'تماس با ما'],
            'contact_title' => ['label' => 'عنوان تماس', 'value' => 'برای مشاوره رایگان با ما تماس بگیرید'],
            'contact_sub' => ['label' => 'توضیح تماس', 'value' => 'فرم زیر را پر کنید تا در کمتر از ۲۴ ساعت با شما تماس بگیریم.'],
            'contact_btn' => ['label' => 'دکمه تماس', 'value' => 'ارسال پیام'],
            'blog_title' => ['label' => 'عنوان وبلاگ', 'value' => 'مقالات و نکات دنیای دیجیتال'],
            'blog_sub' => ['label' => 'توضیح وبلاگ', 'value' => 'آخرین یافته‌ها، راهنماها و تجربیات تیم فنی نوین‌آی'],
            'blog_more' => ['label' => 'متن مشاهده همه', 'value' => 'مشاهده همه مقالات'],
            'newsletter_title' => ['label' => 'عنوان خبرنامه', 'value' => 'از آخرین اخبار و تخفیف‌ها باخبر شوید!'],
            'newsletter_sub' => ['label' => 'توضیح خبرنامه', 'value' => 'هر هفته یک ایمیل، بدون اسپم'],
            'footer_links' => ['label' => 'عنوان لینک‌های سریع', 'value' => 'لینک‌های سریع'],
            'footer_brand' => ['label' => 'نام برند', 'value' => 'مانا'],
            'footer_tag' => ['label' => 'توضیح فوتر', 'value' => 'ارائه‌ی راهکارهای هوشمند دیجیتال؛ از ایده تا اجرا، همراه کسب‌وکار شما برای ساختن آینده‌ای دیجیتال.'],
            'footer_services' => ['label' => 'عنوان خدمات فوتر', 'value' => 'خدمات'],
            'badge1' => ['label' => 'نشان ۱', 'value' => 'قرارداد و محرمانگی NDA'],
            'badge2' => ['label' => 'نشان ۲', 'value' => 'پشتیبانی ۲۴/۷'],
            'badge3' => ['label' => 'نشان ۳', 'value' => 'تحویل به‌موقع پروژه'],
            'badge4' => ['label' => 'نشان ۴', 'value' => 'قیمت‌گذاری شفاف'],
            'copyright' => ['label' => 'کپی‌رایت', 'value' => '© ۲۰۲۶ مانا. تمامی حقوق محفوظ است.'],
        ];

        return view('admin.site-texts.index', compact('texts'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token', '_method') as $key => $value) {
            SiteText::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('site-texts.index')->with('success', 'متن‌ها با موفقیت ذخیره شدند.');
    }
}
