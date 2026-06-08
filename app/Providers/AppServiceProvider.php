<?php

namespace App\Providers;

use App\Models\Gallery;
use App\Models\Image;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $galleries = Gallery::latest()->take(6)->get();
        View::share('settings', $settings);
        View::share('galleries', $galleries);
    }
}
