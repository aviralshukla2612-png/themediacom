<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'image' => 'sample-gallery-1.jpg',
                'category' => 'Events',
                'sort_order' => 1,
            ],
            [
                'image' => 'sample-gallery-2.jpg',
                'category' => 'Portfolio',
                'sort_order' => 2,
            ],
            [
                'image' => 'sample-gallery-3.jpg',
                'category' => 'Corporate',
                'sort_order' => 3,
            ],
            [
                'image' => 'sample-gallery-4.jpg',
                'category' => 'Events',
                'sort_order' => 4,
            ]
        ];

        foreach ($galleries as $gallery) {
            Gallery::firstOrCreate(
                ['image' => $gallery['image']],
                $gallery
            );
        }
    }
}
