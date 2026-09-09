<?php

namespace App\Http\Middleware;

use App\Models\Services;
use Closure;
use App\Models\SiteText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareSiteTexts
{
    public function handle(Request $request, Closure $next)
    {
        $siteTexts = SiteText::get()->keyBy('key');
         $services = Services::orderBy('number', 'asc')->get();

        View::share('siteTexts', $siteTexts);
        View::share('services', $services);


        return $next($request);
    }
}
