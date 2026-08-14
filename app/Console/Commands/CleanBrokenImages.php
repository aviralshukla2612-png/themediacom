<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class CleanBrokenImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-broken-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes gallery records from the database if the physical image file is missing.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $galleries = Gallery::all();
        $deletedCount = 0;

        foreach ($galleries as $gallery) {
            $path = $gallery->image;
            
            // Check if it's a legacy new_gallary path or a storage path
            if (\Illuminate\Support\Str::startsWith($path, ['new_gallary', 'client logo'])) {
                $physicalPath = public_path($path);
                $exists = file_exists($physicalPath);
            } else {
                $exists = Storage::disk('public')->exists($path);
            }

            if (!$exists) {
                $this->info("Missing file found: {$path}. Deleting record from database...");
                $gallery->delete();
                $deletedCount++;
            }
        }

        $this->info("Cleanup complete! Deleted {$deletedCount} broken image records.");
    }
}
