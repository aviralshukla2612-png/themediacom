<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "\n--- CAMPAIGNS ---\n";
echo "Count: " . \App\Models\Campaign::count() . "\n";
$camp = \App\Models\Campaign::first();
echo "First Campaign: " . ($camp ? $camp->title : 'None') . "\n";

// Test Record Create/Read/Delete
echo "Testing DB write/read...\n";
$testCamp = \App\Models\Campaign::create([
    'title' => 'TEST_CAMPAIGN_VERIFICATION',
    'category' => 'Test',
    'image' => 'test.png',
    'problem' => 'Test problem',
    'solution' => 'Test solution',
    'metrics_1_val' => '100',
    'metrics_1_label' => 'Tests',
    'metrics_2_val' => '100',
    'metrics_2_label' => 'Tests',
    'featured' => 0
]);
echo "Test Campaign ID created: " . $testCamp->id . "\n";
$testCamp->delete();
echo "Test Campaign deleted. Verification successful.\n";

echo "\n--- SETTINGS ---\n";
echo "Count: " . \App\Models\Setting::count() . "\n";
$setting = \App\Models\Setting::first();
echo "First Setting: " . ($setting ? $setting->key . ' = ' . substr($setting->value, 0, 30) : 'None') . "\n";

echo "\n--- GALLERY ---\n";
echo "Count: " . \App\Models\Gallery::count() . "\n";
$firstGallery = \App\Models\Gallery::first();
echo "First Gallery Record path: " . ($firstGallery ? $firstGallery->image : 'None') . "\n";

// Check filesystem
$files = glob(public_path('new_gallary/RWA/*.*'));
echo "Files in new_gallary/RWA: " . count($files) . "\n";

echo "\n--- SERVICES ---\n";
echo "Count: " . \App\Models\Service::count() . "\n";

echo "\n--- INQUIRIES ---\n";
echo "Count: " . \App\Models\Inquiry::count() . "\n";

echo "\nDone.\n";
