<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'title' => 'RWA',
                'description' => 'End-to-end residential society activations, community engagement, and brand promotions. We help brands tap directly into upscale residential ecosystems with custom-built kiosks, experiential zones, and interactive community programs designed for immediate brand recall and high conversion rates.',
                'icon' => 'fa-house-chimney-user',
                'link' => 'contact.php?service=rwa',
                'status' => 1
            ],
            [
                'title' => 'BTL',
                'description' => 'Creative below-the-line marketing activities designed to increase customer engagement. From roadshows and canter van campaigns to localized street activations, we take your brand right to your target audience.',
                'icon' => 'fa-bullhorn',
                'link' => 'contact.php?service=btl',
                'status' => 1
            ],
            [
                'title' => 'Mall Promotion',
                'description' => 'Interactive mall and retail activations to enhance customer experience and brand visibility. Capture high-intent shoppers in premium mall spaces with immersive tech setups and eye-catching stalls.',
                'icon' => 'fa-bag-shopping',
                'link' => 'contact.php?service=mall',
                'status' => 1
            ],
            [
                'title' => 'Corporate Event',
                'description' => 'Professional planning and execution of corporate activations, dealer meets, employee engagement programs, and flagship product launches with high visual impact.',
                'icon' => 'fa-building',
                'link' => 'contact.php?service=corporate',
                'status' => 1
            ],
            [
                'title' => 'Other',
                'description' => 'Need a custom activation or a hybrid campaign tailored specifically to your brand objectives? Our experiential strategists will design and execute a bespoke concept from scratch.',
                'icon' => 'fa-lightbulb',
                'link' => 'contact.php',
                'status' => 1
            ]
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['title' => $service['title']], $service);
        }
    }
}
