<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Model::preventLazyLoading(!$this->app->isProduction());

        Paginator::useBootstrap();

        View()->composer(['content.participant.v_dashboard', 'content.admin.v_dashboard', 'layout.public.nav_menu'], function ($view) {
            return Cache::remember('setting', 60, function () use ($view) {
                $setting = Setting::first();
                session()->put('school_year', $setting['school_year'] ?? null);
                session()->put('name_program', $setting['name_program'] ?? null);
                session()->put('name_school', $setting['name_school'] ?? null);
                session()->put('logo_school', $setting['logo_school'] ?? null);
            });
        });

        View()->composer('plugins.component.banner', function ($view) {
            $banner = Banner::first();
            return Cache::remember('banner', 60, function () use ($banner, $view) {
                $view->with(['banner' => $banner]);
            });
        });


        View()->composer('layout.admin.sidebar', function ($view) {
            $count_message = Message::where([
                ['closed', 0],
                ['status', 1]
            ])->count();
            $view->with(['count_message' => $count_message]);
        });

        View()->composer('layout.participant.sidebar', function ($view) {
            $count_message = Message::where([
                ['id_participant', Auth::guard('participant')->user()->id],
                ['closed', 0],
                ['status', 1]
            ])->count();
            $view->with(['count_message' => $count_message]);
        });
    }
}
