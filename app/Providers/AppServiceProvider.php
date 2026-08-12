<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\SeoSetting;
use App\Models\SiteSetting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ── Scheduled Logo Check ────────────────────────────────────────────
        // No cron needed. On every page load we check a lightweight 60-second
        // cache key. If it has expired (i.e. a minute has passed), we query
        // the DB once for a pending logo swap. If the time has come, we apply
        // it instantly via a direct DB update and bust the settings cache.
        // Cost: one cache.get per request, one DB query per minute at most.
        $lastCheck = Cache::get('logo_schedule_last_check', 0);

        if (now()->timestamp - $lastCheck >= 60) {
            // Mark this minute as checked immediately so concurrent requests
            // don't all hit the DB at once
            Cache::put('logo_schedule_last_check', now()->timestamp, 120);

            $pending = SiteSetting::whereNotNull('scheduled_logo')
                ->whereNotNull('scheduled_logo_at')
                ->where('scheduled_logo_at', '<=', now())
                ->first();

            if ($pending) {
                // Use DB facade directly — bypasses model observers so we
                // don't accidentally recurse into Cache::forget inside
                // the observer while we're still building the view data
                DB::table('site_settings')
                    ->where('id', $pending->id)
                    ->update([
                        'logo_image'        => $pending->scheduled_logo,
                        'scheduled_logo'    => null,
                        'scheduled_logo_at' => null,
                        'updated_at'        => now(),
                    ]);

                // Bust the main settings cache so the new logo loads
                // on this very request (re-built below)
                Cache::forget('global_seo_settings');
            }
        }
        // ───────────────────────────────────────────────────────────────────

        View::composer('*', function ($view) {
            $settings = Cache::remember('global_seo_settings', 3600, function () {
                $seo     = \App\Models\SeoSetting::first();
                $contact = \App\Models\ContactSetting::first();
                $site    = \App\Models\SiteSetting::first();
                return [
                    'seo_title'       => $seo?->seo_title       ?? 'The Media Com | Brand Activation & BTL Agency',
                    'seo_description' => $seo?->seo_description ?? 'The Media Com is a leading Brand Activation and BTL Agency.',
                    'seo_image'       => $seo?->seo_image        ?? '',

                    'site_name'       => $site?->site_name       ?? 'The Media Com',
                    'logo_image'      => $site?->logo_image      ? asset('storage/' . $site->logo_image) : asset('mediaconlogo_nav.png'),
                    'favicon_image'   => $site?->favicon_image   ? asset('storage/' . $site->favicon_image) : asset('mediaconlogo_nav.png'),

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
