<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Gallery;

class SyncLegacyGallery extends Command
{
    protected $signature = 'gallery:sync-legacy {--dry-run : Simulate the sync without inserting records}';
    protected $description = 'Safely synchronize legacy filesystem gallery images into the database';

    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        $baseDir = public_path('new_gallary');
        
        $categoryMappings = [
            'RWA' => 'rwa',
            'BTL Activity' => 'btl',
            'Mall Promotions' => 'mall',
            'Corporate Events' => 'corporate'
        ];

        $foundImages = 0;
        $wouldInsert = 0;
        $wouldSkip = 0;
        $wouldDelete = 0; // Strictly 0
        $wouldMove = 0;   // Strictly 0
        $wouldRename = 0; // Strictly 0

        $imagesToInsert = [];

        foreach ($categoryMappings as $dirName => $catKey) {
            $fullPath = $baseDir . DIRECTORY_SEPARATOR . $dirName;
            
            if (File::isDirectory($fullPath)) {
                $files = File::files($fullPath);
                
                foreach ($files as $file) {
                    $ext = strtolower($file->getExtension());
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'mp4'])) {
                        $foundImages++;
                        $relPath = 'new_gallary/' . $dirName . '/' . $file->getFilename();
                        
                        // Check if exists
                        $exists = Gallery::where('image', $relPath)->exists();
                        
                        if ($exists) {
                            $wouldSkip++;
                        } else {
                            $wouldInsert++;
                            $imagesToInsert[] = [
                                'image' => $relPath,
                                'category' => $catKey
                            ];
                        }
                    }
                }
            }
        }

        $this->info("Filesystem images found: " . $foundImages);
        $this->info("");
        $this->info("Category mapping:");
        foreach ($categoryMappings as $dirName => $catKey) {
            $this->line(str_pad($dirName, 18) . " → " . $catKey);
        }
        
        $this->info("");
        $this->info("Would insert: " . $wouldInsert);
        $this->info("Would skip:   " . $wouldSkip);
        $this->info("Would delete: " . $wouldDelete);
        $this->info("Would move:   " . $wouldMove);
        $this->info("Would rename: " . $wouldRename);
        $this->info("");

        if ($isDryRun) {
            $this->warn("DRY RUN: No database records were inserted.");
            return Command::SUCCESS;
        }

        if ($wouldInsert > 0) {
            $this->info("Inserting records into database...");
            foreach ($imagesToInsert as $img) {
                // Determine sort_order max for category
                $maxSort = Gallery::where('category', $img['category'])->max('sort_order');
                $nextSort = $maxSort ? $maxSort + 1 : 1;
                
                Gallery::create([
                    'image' => $img['image'],
                    'category' => $img['category'],
                    'sort_order' => $nextSort
                ]);
            }
            $this->info("Successfully inserted {$wouldInsert} records.");
        } else {
            $this->info("No new records to insert.");
        }

        return Command::SUCCESS;
    }
}
