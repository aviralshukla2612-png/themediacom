<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MigrateGallerySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'rwa'       => 'new_gallary/RWA',
            'btl'       => 'new_gallary/BTL Activity',
            'mall'      => 'new_gallary/Mall Promotions',
            'corporate' => 'new_gallary/Corporate Events'
        ];

        $sortOrder = 10;
        $count = 0;

        foreach ($categories as $cat_key => $dir_path) {
            $full_path = public_path($dir_path);
            if (File::isDirectory($full_path)) {
                $files = File::files($full_path);
                foreach ($files as $file) {
                    $ext = strtolower($file->getExtension());
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'mp4', 'webp'])) {
                        
                        // Destination filename
                        $filename = uniqid() . '_' . $file->getFilename();
                        $destPath = 'gallery/' . $filename;
                        
                        // Copy file to storage
                        Storage::disk('public')->put($destPath, File::get($file->getPathname()));
                        
                        // Create DB record
                        Gallery::create([
                            'category' => $cat_key,
                            'image' => $destPath,
                            'sort_order' => $sortOrder++
                        ]);
                        
                        $count++;
                    }
                }
            }
        }
        
        $this->command->info("Migrated $count gallery images to the database!");
    }
}
