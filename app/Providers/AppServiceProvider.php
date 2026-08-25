<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\SiteText;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {

        if (! $this->app->runningInConsole()) {
            if (Schema::hasTable('site_texts')) {
                $siteTexts = SiteText::pluck('value', 'key')->toArray();
                View::share('siteTexts', $siteTexts);
            }

            if (Schema::hasTable('settings')) {

                $siteSettings = Setting::pluck('value', 'key')->toArray();
                View::share('siteSettings', $siteSettings);
            }
        }
    }
}