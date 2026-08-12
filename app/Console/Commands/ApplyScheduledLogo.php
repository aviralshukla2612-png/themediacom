<?php

namespace App\Console\Commands;

use App\Models\SiteSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class ApplyScheduledLogo extends Command
{
    protected $signature   = 'logo:apply-scheduled';
    protected $description = 'Check for a pending scheduled logo change and apply it if the time has come.';

    public function handle(): int
    {
        $setting = SiteSetting::first();

        // Nothing scheduled — exit silently
        if (! $setting || ! $setting->scheduled_logo || ! $setting->scheduled_logo_at) {
            return Command::SUCCESS;
        }

        $scheduledAt = Carbon::parse($setting->scheduled_logo_at);

        // Not time yet — exit silently
        if ($scheduledAt->isFuture()) {
            return Command::SUCCESS;
        }

        // ✅ Time has come — apply the logo swap
        $setting->update([
            'logo_image'       => $setting->scheduled_logo,
            'scheduled_logo'   => null,
            'scheduled_logo_at'=> null,
        ]);

        // Bust the global settings cache so the new logo shows immediately
        Cache::forget('global_seo_settings');

        $this->info("✅ Scheduled logo applied successfully at " . now()->toDateTimeString());

        return Command::SUCCESS;
    }
}
