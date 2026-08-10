<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\SeoSetting;

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
        View::composer('layouts.app', function ($view) {
            $settings = Cache::remember('global_seo_settings', 3600, function () {
                $seo = SeoSetting::first();
                return [
                    'seo_title'       => $seo?->seo_title       ?? 'The Media Com | Brand Activation & BTL Agency',
                    'seo_description' => $seo?->seo_description ?? 'The Media Com is a leading Brand Activation and BTL Agency.',
                    'seo_image'       => $seo?->seo_image        ?? '',
                ];
            });
            $view->with('global_seo', $settings);
        });
    }
}
