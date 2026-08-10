<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            'about_hero_bg' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            'about_page_title' => 'About The Media Com',
            'about_page_subtitle' => 'Turning ideas into experiences and helping brands build stronger connections.',
            'btl_metric_reached' => '5M+',
            'btl_metric_malls' => '200+',
            'btl_metric_locations' => '50+',
            'corporate_hero_bg' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            'corporate_page_title' => 'Executive Experiences',
            'corporate_page_subtitle' => 'Crafting elegant and seamless corporate events that reflect the prestige of your brand.',
            'corporate_img_1' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
            'corporate_img_2' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
            'maps_url' => 'https://maps.google.com',
            'address' => '123 Media Street',
            'phone' => '+1 234 567 8900',
            'email' => 'info@themediacom.com',
            'seo_title' => 'The Media Com | From Strategy to Street — WE EXECUTE',
            'seo_description' => 'The Media Com is a leading brand activation and event execution company dedicated to creating impactful on-ground marketing experiences.',
            'seo_image' => 'mediaconlogo2.png',
        ];

        $inserted = 0;
        $existing = 0;

        foreach ($settings as $key => $value) {
            $setting = Setting::where('setting_key', $key)->first();
            
            if ($setting) {
                $existing++;
            } else {
                Setting::create([
                    'setting_key' => $key,
                    'setting_value' => $value,
                ]);
                $inserted++;
            }
        }

        $this->command->info("Settings Seeder Completed:");
        $this->command->info("- Inserted new settings: {$inserted}");
        $this->command->info("- Skipped existing settings: {$existing}");
    }
}
