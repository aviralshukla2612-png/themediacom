<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$files = scandir(__DIR__.'/database/migrations');
foreach($files as $f) {
    if(strpos($f, '.php') !== false && strpos($f, 'add_remember_token') === false) {
        $m = str_replace('.php', '', $f);
        DB::table('migrations')->insertOrIgnore(['migration' => $m, 'batch' => 1]);
    }
}
echo 'Marked all previous migrations';
