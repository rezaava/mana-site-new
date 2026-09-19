<?php

namespace App\Http\Middleware;

use App\Models\Services;
use App\Models\Setting;
use App\Models\SiteText;
use App\Models\Socials;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareSiteTexts
{
    public function handle(Request $request, Closure $next)
    {
        $siteTexts = SiteText::get()->keyBy('key');
        $services = Services::orderBy('number', 'asc')->get();
        $socials = Socials::get();
        $setting = Setting::all()->keyBy('key');

        View::share('siteTexts', $siteTexts);
        View::share('setting', $setting);
        View::share('services', $services);
        View::share('socials', $socials);

        return $next($request);
    }
}