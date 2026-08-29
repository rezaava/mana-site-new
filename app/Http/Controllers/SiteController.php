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
        $services = Services::orderBy('number', 'asc')->get();

        $projects = Projects::orderBy('number', 'asc')->limit(6)->get();

        $teams = Team::orderBy('id', 'desc')->get();

        $questions = Questions::orderBy('number', 'asc')->get();

        $blogs = Blogs::orderBy('number', 'asc')->limit(4)->get();

        $comments = Comments::where('is_approved', true)->latest()->limit(6)->get();

        $stats = [
            'projects_count'  => SiteText::where('key', 'stat1_num')->value('value') ?? Projects::count(),
            'satisfaction'    => SiteText::where('key', 'stat2_num')->value('value') ?? '۹۸%',
            'customers_count' => SiteText::where('key', 'stat3_num')->value('value') ?? '۵۰+',
            'support_hours'   => SiteText::where('key', 'stat4_num')->value('value') ?? '۲۴/۷',
        ];

        return view('index', compact(
            'services', 
            'projects', 
            'teams', 
            'questions', 
            'blogs', 
            'comments', 
            'stats'
        ));
    }

    /**
     * صفحه لیست وبلاگ‌ها
     */
    public function all_blogs()
    {
        $blogs = Blogs::orderBy('number', 'asc')->latest()->paginate(9);
        return view('blog.all_blogs', compact('blogs'));
    }

    /**
     * صفحه تکی مقاله وبلاگ
     */
    public function singleBlog($id)
    {
        $blog = Blogs::findOrFail($id);
        
        $siteTexts = SiteText::pluck('value', 'key')->toArray();

        $relatedBlogs = Blogs::where('id', '!=', $id)
            ->orderBy('number', 'asc')
            ->limit(3)
            ->get();

        return view('blog.singleblog', compact('blog', 'relatedBlogs', 'siteTexts'));
    }

    /**
     * صفحه جزئیات پروژه/نمونه‌کار
     */
    public function project($id)
    {
        $project = Projects::findOrFail($id);
        
        $images = Images::where('type', 1)->where('sub_id', $id)->get();

        $features = Features::where('type', 1)->where('sub_id', $id)->get();

        return view('project', compact('project', 'images', 'features'));
    }
}