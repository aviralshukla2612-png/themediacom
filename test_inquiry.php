<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    App\Models\Inquiry::create([
        'form_type' => 'test',
        'name' => 'Test Name',
        'company' => '',
        'service_type' => 'BTL',
        'email' => '',
        'phone' => '1234567890',
        'budget_range' => null,
        'message' => null,
        'extra_data' => null,
        'status' => 'New'
    ]);
    echo 'Success';
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
