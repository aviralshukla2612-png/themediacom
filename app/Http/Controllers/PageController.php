<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutContent;
use App\Models\CorporateContent;
use App\Models\ServicePageContent;
use App\Models\ContactSetting;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index()
    {
        $home = \App\Models\HomeContent::first();
        $clients = \App\Models\ClientLogo::where('status', 1)->orderBy('sort_order')->get();
        return view('index', compact('home', 'clients'));
    }

    public function about()
    {
        $about = AboutContent::first();

        $about_hero_bg  = $about?->hero_image  ?: 'https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
        $about_title    = $about?->heading      ?: 'About The Media Com';
        $about_subtitle = $about?->subtitle     ?: 'Turning ideas into experiences and helping brands build stronger connections.';
        $about_paragraph = $about?->paragraph   ?: 'The Media Com is a leading brand activation and event execution company dedicated to creating impactful on-ground marketing experiences.';

        return view('about', compact('about_hero_bg', 'about_title', 'about_subtitle', 'about_paragraph'));
    }

    public function services()
    {
        $svc = ServicePageContent::first();

        $btl_metric_reached   = $svc?->btl_metric_reached   ?: '5M+';
        $btl_metric_malls     = $svc?->btl_metric_malls     ?: '200+';
        $btl_metric_locations = $svc?->btl_metric_locations ?: '50+';

        $services = [];
        try {
            $services = Service::where('status', 1)->orderBy('id')->get();
        } catch (\Exception $e) {
            // DB fallback
        }

        return view('services', compact('btl_metric_reached', 'btl_metric_malls', 'btl_metric_locations', 'services'));
    }

    public function corporate()
    {
        $corp = CorporateContent::first();

        $corp_hero_bg  = $corp?->hero_bg       ?: 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
        $corp_title    = $corp?->page_title    ?: 'Executive Experiences';
        $corp_subtitle = $corp?->page_subtitle ?: 'Crafting elegant and seamless corporate events that reflect the prestige of your brand.';
        $corp_img_1    = $corp?->img_1         ?: 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80';
        $corp_img_2    = $corp?->img_2         ?: 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80';

        return view('corporate', compact('corp_hero_bg', 'corp_title', 'corp_subtitle', 'corp_img_1', 'corp_img_2'));
    }

    public function gallery()
    {
        $gallery_items = [];

        try {
            $galleries = Gallery::orderBy('sort_order', 'asc')->get();
            if ($galleries->isNotEmpty()) {
                foreach ($galleries as $g) {
                    $gallery_items[] = [
                        'category' => $g->category,
                        'path'     => $g->image,
                        'title'    => ucwords(str_replace(['-', '_'], ' ', pathinfo($g->image, PATHINFO_FILENAME))),
                        'is_video' => strtolower(pathinfo($g->image, PATHINFO_EXTENSION)) === 'mp4'
                    ];
                }
            }
        } catch (\Exception $e) {
            // DB might be down or not migrated
        }

        // Also load from filesystem folders and merge them with DB items
        $categories = [
            'rwa'       => 'new_gallary/RWA',
            'btl'       => 'new_gallary/BTL Activity',
            'mall'      => 'new_gallary/Mall Promotions',
            'corporate' => 'new_gallary/Corporate Events'
        ];

        foreach ($categories as $cat_key => $dir_path) {
            $full_path = public_path($dir_path);
            if (File::isDirectory($full_path)) {
                $files = File::files($full_path);
                foreach ($files as $file) {
                    $ext = strtolower($file->getExtension());
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'mp4'])) {
                        $name_without_ext = $file->getFilenameWithoutExtension();
                        $clean_title = preg_replace('/\(\d+\)/', '', $name_without_ext);
                        $clean_title = str_replace(['-', '_'], ' ', $clean_title);
                        $clean_title = ucwords(trim($clean_title));
                        $clean_title = preg_replace('/\s+/', ' ', $clean_title);

                        if (empty($clean_title) || strlen($clean_title) < 2) {
                            $clean_title = ucwords($cat_key) . ' Campaign';
                        }

                        $gallery_items[] = [
                            'category' => $cat_key,
                            'path'     => $dir_path . '/' . $file->getFilename(),
                                'title'    => $clean_title,
                                'is_video' => $ext === 'mp4'
                            ];
                        }
                    }
                }
            }

        return view('gallery', compact('gallery_items'));
    }

    public function contact()
    {
        $contact = ContactSetting::first();

        $mapsUrl  = $contact?->maps_url ?: 'https://maps.google.com';
        $address  = $contact?->address  ?: '123 Media Street';
        $phone    = $contact?->phone    ?: '+91 98765 43210';
        $phoneDig = preg_replace('/[^0-9+]/', '', $phone);
        $email    = $contact?->email    ?: 'info@themediacom.com';

        return view('contact', compact('mapsUrl', 'address', 'phone', 'phoneDig', 'email'));
    }

    public function ai()
    {
        return view('ai');
    }
}
