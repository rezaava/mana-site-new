<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Projects;
use App\Models\Services;
use App\Models\Team;
use App\Models\Questions;
use App\Models\Comments;
use App\Models\Images;
use App\Models\Features;
use App\Models\SiteText;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * صفحه اصلی سایت
     */
    public function index()
    {
        // ۱. دریافت خدمات مرتب‌شده بر اساس ستون number
        $services = Services::orderBy('number', 'asc')->get();

        // ۲. دریافت ۶ پروژه اخیر/مرتب‌شده
        $projects = Projects::orderBy('number', 'asc')->limit(6)->get();

        // ۳. اعضای تیم
        $team = Team::orderBy('id', 'desc')->get();

        // ۴. سوالات متداول مرتب‌شده
        $questions = Questions::orderBy('number', 'asc')->get();

        // ۵. ۴ مقاله اخیر وبلاگ
        $blogs = Blogs::orderBy('number', 'asc')->limit(4)->get();

        // ۶. نظرات تایید شده
        $comments = Comments::where('is_approved', true)->latest()->limit(6)->get();

        // ۷. محاسبه آمار واقعی از روی دیتابیس (با قابلیت دریافت متن جایگزین از site_texts)
        $stats = [
            'projects_count'  => SiteText::where('key', 'stat1_num')->value('value') ?? Projects::count(),
            'satisfaction'    => SiteText::where('key', 'stat2_num')->value('value') ?? '۹۸%',
            'customers_count' => SiteText::where('key', 'stat3_num')->value('value') ?? '۵۰+',
            'support_hours'   => SiteText::where('key', 'stat4_num')->value('value') ?? '۲۴/۷',
        ];

        return view('index', compact(
            'services', 
            'projects', 
            'team', 
            'questions', 
            'blogs', 
            'comments', 
            'stats'
        ));
    }

    /**
     * صفحه لیست وبلاگ‌ها
     */
    public function blog()
    {
        $blogs = Blogs::orderBy('number', 'asc')->latest()->paginate(9);
        return view('blog', compact('blogs'));
    }

    /**
     * صفحه تکی مقاله وبلاگ
     */
    public function singleBlog($id)
    {
        $blog = Blogs::findOrFail($id);
        
        // مقالات مرتبط (به جز مقاله فعلی)
        $relatedBlogs = Blogs::where('id', '!=', $id)
            ->orderBy('number', 'asc')
            ->limit(3)
            ->get();

        // نظرات تایید شده
        $comments = Comments::where('is_approved', true)->latest()->get();

        return view('blog.singleblog', compact('blog', 'relatedBlogs', 'comments'));
    }

    /**
     * صفحه جزئیات پروژه/نمونه‌کار
     */
    public function project($id)
    {
        $project = Projects::findOrFail($id);
        
        // عکس‌های گالری پروژه (Type 1 مربوط به پروژه‌ها)
        $images = Images::where('type', 1)->where('sub_id', $id)->get();

        // ویژگی‌های پروژه (Type 1)
        $features = Features::where('type', 1)->where('sub_id', $id)->get();

        return view('project', compact('project', 'images', 'features'));
    }
}