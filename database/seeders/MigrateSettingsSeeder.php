<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactSetting;
use App\Models\CorporateContent;
use App\Models\ServicePageContent;
use App\Models\SeoSetting;
use App\Models\AboutContent;
use Illuminate\Support\Facades\DB;

class MigrateSettingsSeeder extends Seeder
{
    /**
     * Migrate data from the old flat `settings` table into the new structured tables.
     * Safe to run multiple times — only inserts if the new table is empty.
     */
    public function run(): void
    {
        // Helper to get a setting value
        $get = fn ($key, $default = null) => DB::table('settings')
            ->where('setting_key', $key)
            ->value('setting_value') ?? $default;

        // 1. Contact Settings
        if (ContactSetting::count() === 0) {
            ContactSetting::create([
                'email'    => $get('email', 'info@themediacom.com'),
                'phone'    => $get('phone', '+91 98765 43210'),
                'address'  => $get('address', '123 Media Street, New Delhi'),
                'maps_url' => $get('maps_url', 'https://maps.google.com'),
            ]);
            $this->command->info('✅ ContactSetting migrated.');
        } else {
            $this->command->warn('⚠ ContactSetting already has data — skipping.');
        }

        // 2. Corporate Content
        if (CorporateContent::count() === 0) {
            CorporateContent::create([
                'page_title'    => $get('corporate_page_title', 'Executive Experiences'),
                'page_subtitle' => $get('corporate_page_subtitle', 'Crafting elegant and seamless corporate events that reflect the prestige of your brand.'),
                'hero_bg'       => $get('corporate_hero_bg', ''),
                'img_1'         => $get('corporate_img_1', ''),
                'img_2'         => $get('corporate_img_2', ''),
            ]);
            $this->command->info('✅ CorporateContent migrated.');
        } else {
            $this->command->warn('⚠ CorporateContent already has data — skipping.');
        }

        // 3. Service Page Content (BTL Metrics)
        if (ServicePageContent::count() === 0) {
            ServicePageContent::create([
                'btl_metric_reached'   => $get('btl_metric_reached', '5M+'),
                'btl_metric_malls'     => $get('btl_metric_malls', '200+'),
                'btl_metric_locations' => $get('btl_metric_locations', '50+'),
            ]);
            $this->command->info('✅ ServicePageContent migrated.');
        } else {
            $this->command->warn('⚠ ServicePageContent already has data — skipping.');
        }

        // 4. SEO Settings
        if (SeoSetting::count() === 0) {
            SeoSetting::create([
                'seo_title'       => $get('seo_title', 'The Media Com | Brand Activation & BTL Agency'),
                'seo_description' => $get('seo_description', 'The Media Com is a leading Brand Activation and BTL Agency specializing in RWA events, mall promotions, and corporate events.'),
                'seo_image'       => $get('seo_image', ''),
            ]);
            $this->command->info('✅ SeoSetting migrated.');
        } else {
            $this->command->warn('⚠ SeoSetting already has data — skipping.');
        }

        // 5. About Content — migrate from settings into about_contents
        $aboutHeroBg    = $get('about_hero_bg', '');
        $aboutTitle     = $get('about_page_title', 'About The Media Com');
        $aboutSubtitle  = $get('about_page_subtitle', 'Turning ideas into experiences and helping brands build stronger connections.');

        if (AboutContent::count() === 0) {
            AboutContent::create([
                'heading'    => $aboutTitle,
                'subtitle'   => $aboutSubtitle,
                'hero_image' => $aboutHeroBg,
                'paragraph'  => 'We are The Media Com — a results-driven brand activation agency.',
                'metrics'    => null,
            ]);
            $this->command->info('✅ AboutContent populated from settings.');
        } else {
            // Update existing record to fill in missing title/subtitle from settings if empty
            $about = AboutContent::first();
            if (empty($about->heading) && !empty($aboutTitle)) {
                $about->update(['heading' => $aboutTitle]);
            }
            if (empty($about->subtitle) && !empty($aboutSubtitle)) {
                $about->update(['subtitle' => $aboutSubtitle]);
            }
            if (empty($about->hero_image) && !empty($aboutHeroBg)) {
                $about->update(['hero_image' => $aboutHeroBg]);
            }
            $this->command->info('✅ AboutContent updated with settings data.');
        }

        $this->command->info('');
        $this->command->info('🎉 Settings migration complete! All data preserved.');
        $this->command->warn('ℹ The old `settings` table has NOT been dropped. Verify the new CMS, then run: php artisan app:drop-settings');
    }
}
