<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use App\Models\User;

echo "Role column exists? " . (Schema::hasColumn('users', 'role') ? 'YES' : 'NO') . "\n";
echo "Number of users: " . User::count() . "\n";
$users = User::all();
foreach ($users as $user) {
    echo "User: {$user->email}, Role: " . ($user->role ?? 'UNDEFINED') . "\n";
}
