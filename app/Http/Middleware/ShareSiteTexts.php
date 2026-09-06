<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SiteText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareSiteTexts
{
    public function handle(Request $request, Closure $next)
    {
        $siteTexts = SiteText::get()->keyBy('key');

        View::share('siteTexts', $siteTexts);

        return $next($request);
    }
}
