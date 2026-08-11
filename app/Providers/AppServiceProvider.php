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
        View::composer('*', function ($view) {
            $settings = Cache::remember('global_seo_settings', 3600, function () {
                $seo = \App\Models\SeoSetting::first();
                $contact = \App\Models\ContactSetting::first();
                return [
                    'seo_title'       => $seo?->seo_title       ?? 'The Media Com | Brand Activation & BTL Agency',
                    'seo_description' => $seo?->seo_description ?? 'The Media Com is a leading Brand Activation and BTL Agency.',
                    'seo_image'       => $seo?->seo_image        ?? '',
                    
                    'logo_image'      => $contact?->logo_image   ? asset('storage/' . $contact->logo_image) : asset('mediaconlogo_nav.png'),
                    'favicon_image'   => $contact?->favicon_image ? asset('storage/' . $contact->favicon_image) : asset('mediaconlogo_nav.png'),
                    
                    'contact_email'   => $contact?->email        ?? 'info@themediacom.com',
                    'contact_phone'   => $contact?->phone        ?? '+91 88664 46225',
                    'contact_address' => $contact?->address      ?? 'Ahmedabad',
                    'maps_url'        => $contact?->maps_url     ?? 'https://maps.google.com/?q=Ahmedabad',
                    'footer_text'     => $contact?->footer_text  ?? null,
                ];
            });
            $view->with('global_seo', $settings);
        });
    }
}
