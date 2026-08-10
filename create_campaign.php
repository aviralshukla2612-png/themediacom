<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\App\Models\Campaign::create(['title' => 'Test Campaign', 'category' => 'BTL', 'image' => 'new_gallary/test.jpg', 'problem' => '<b>Some problem with HTML</b> that needs to be stripped out for SEO purposes.', 'featured' => 1]);
