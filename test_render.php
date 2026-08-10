<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$html = app('view')->make('services', [
    'services' => \App\Models\Service::all(),
    'btl_metric_reached' => '5M',
    'btl_metric_malls' => '200',
    'btl_metric_locations' => '50'
])->render();

if (strpos($html, 'TEST_SERVICE_PHASE_E') !== false) {
    echo "SUCCESS: TEST_SERVICE_PHASE_E found in rendered HTML.\n";
} else {
    echo "FAIL: TEST_SERVICE_PHASE_E not found.\n";
}
