<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use App\Models\ClientLogo;
use Illuminate\Support\Facades\File;

class ImportExistingImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Import Galleries
        $galleryPath = public_path('new_gallary');
        if (File::exists($galleryPath)) {
            // Use allFiles to scan subdirectories recursively
            $files = File::allFiles($galleryPath);
            foreach ($files as $file) {
                // Ensure it's an image
                if (in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                    // Get the relative path starting from new_gallary (e.g., new_gallary/RWA/image.jpg)
                    $relativePath = 'new_gallary/' . $file->getRelativePathname();
                    // Replace backslashes with forward slashes for URLs
                    $imagePath = str_replace('\\', '/', $relativePath);
                    
                    Gallery::firstOrCreate(
                        ['image' => $imagePath],
                        [
                            'category' => 'corporate', // Default category
                        ]
                    );
                }
            }
            $this->command->info('Synced ' . count($files) . ' images to Galleries.');
        }

        // 2. Import Client Logos
        $clientLogoPath = public_path('client logo');
        if (File::exists($clientLogoPath)) {
            $files = File::files($clientLogoPath);
            foreach ($files as $file) {
                $filename = $file->getFilename();
                // Ensure it's an image
                if (in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                    $imagePath = 'client logo/' . $filename;
                    
                    // Extract name from filename for default
                    $name = pathinfo($filename, PATHINFO_FILENAME);
                    $name = ucwords(str_replace(['-', '_'], ' ', $name));

                    ClientLogo::firstOrCreate(
                        ['image' => $imagePath],
                        [
                            'name' => $name,
                            'status' => true,
                            'sort_order' => 0,
                        ]
                    );
                }
            }
            $this->command->info('Synced ' . count($files) . ' images to Client Logos.');
        }
    }
}
