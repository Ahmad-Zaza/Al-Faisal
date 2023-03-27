<?php

namespace App\Providers;

use App\Http\Models\SiteMenu;
use App\Http\Models\Slider;
use App\Seo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $lang = config('app.locale');
        $menu = SiteMenu::where('active', '=', 1)
        ->orderBy('id')
        ->get();
        $seo = Seo::orderBy('sorting')->get();
        View::share('lang', $lang);
        View::share('seo', $seo);  
        View::share('menu', $menu);
        Schema::defaultStringLength(191);
        // URL::forceScheme('https');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
