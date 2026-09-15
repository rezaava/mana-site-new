<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Categories;
use App\Models\Order;
use App\Models\Projects;
use App\Models\Services;
use App\Models\Team;
use App\Models\Questions;
use App\Models\Comments;
use App\Models\ServiceState;
use App\Models\ServiceTech;
use App\Models\ServiceWhatReceive;
use App\Models\Ticket;
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
        $projects = Projects::orderBy('number', 'asc')
            ->limit(6)
            ->get();

        foreach ($projects as $project) {
            $project['category'] = Categories::where('id', $project->cat_id)->first();
        }

        $teams = Team::orderBy('id', 'desc')->get();

        $questions = Questions::where('service_id',null)->orderBy('number', 'asc')->get();

        $blogs = Blogs::orderBy('number', 'asc')
            ->limit(4)
            ->get();

        $comments = Comments::where('is_approved', true)
            ->latest()
            ->limit(6)
            ->get();

        $siteTexts = SiteText::get()->keyBy('key');

        $stats = [
            'projects_count' => $siteTexts->has('stat1_num') ? $siteTexts['stat1_num']->value : Projects::count(),
            'customers_count' => $siteTexts->has('stat3_num') ? $siteTexts['stat3_num']->value : '۵۰+',
            'support_hours' => $siteTexts->has('stat4_num') ? $siteTexts['stat4_num']->value : '۲۴/۷',
            'satisfaction' => $siteTexts->has('stat2_num') ? $siteTexts['stat2_num']->value : '۹۸%',
        ];

        return view('index', compact(
            'projects',
            'teams',
            'questions',
            'blogs',
            'comments',
            'stats',
        ));
    }

    public function index_admin()
    {
        $projectsCount = Projects::count();
        $blogsCount = Blogs::count();
        $servicesCount = Services::count();
        $ticketsCount = Ticket::count();

        return view('admin.dashboard', compact(
            'projectsCount',
            'blogsCount',
            'servicesCount',
            'ticketsCount'
        ));
    }
    /**
     * صفحه لیست وبلاگ‌ها
     */
    public function all_blogs()
    {
        $blogs = Blogs::orderBy('number', 'asc')
            ->latest()
            ->paginate(9);

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

        return view('blog.singleblog', compact(
            'blog',
            'relatedBlogs',
            'siteTexts'
        ));
    }

    /**
     * صفحه جزئیات پروژه/نمونه‌کار
     */
    public function project($id)
    {
        $project = Projects::findOrFail($id);

        $images = Images::where('type', 1)
            ->where('sub_id', $id)
            ->get();

        $features = Features::where('type', 1)
            ->where('sub_id', $id)
            ->get();

        return view('project', compact(
            'project',
            'images',
            'features'
        ));
    }

    public function servise($slug)
    {
        $service = Services::where('slug', $slug)->firstOrFail();

        $questions = Questions::where('service_id', $service->id)->orderBy('number')->get();

        $state = ServiceState::where('service_id', $service->id)->first();

        $techs = ServiceTech::where('service_id', $service->id)
            ->orderBy('number', 'asc')
            ->get();

        $whatReceives = ServiceWhatReceive::where('service_id', $service->id)
            ->orderBy('number', 'asc')
            ->get();

        return view('service', compact(
            'service',
            'state',
            'techs',
            'whatReceives',
            'questions',
        ));
    }

    public function orderForm($id)
    {
        $currentService = Services::findOrFail($id);
        $services = Services::orderBy('number')->get();

        return view('order', compact('currentService', 'services'));
    }

    public function orderStore(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string',
            'phone' => 'required',
            'email' => 'nullable',
            'company' => 'nullable',
            'service' => 'required|integer|exists:categories,id',
            'budget' => 'nullable',
            'timeline' => 'nullable',
            'description' => 'required'
        ]);

        $order = new Order();

        $order->fullname = $validated['fullname'];
        $order->phone = $validated['phone'];
        $order->email = $validated['email'];
        $order->company = $validated['company'];
        $order->service_id = $validated['service'];
        $order->budget = $validated['budget'];
        $order->timeline = $validated['timeline'];
        $order->description = $validated['description'];

        $order->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'سفارش با موفقیت ثبت شد',
            ], 200);
        }

        return redirect()->back()->with('success', 'سفارش با موفقیت ثبت شد');
    }
}