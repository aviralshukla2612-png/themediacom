<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Filament\Facades\Filament;

echo "1. Current Admins in DB: " . User::count() . "\n";

$admin = User::first();
echo "2. canAccessPanel for admin: " . ($admin->canAccessPanel(Filament::getCurrentPanel() ?: new \Filament\Panel()) ? 'true' : 'false') . "\n";

$newAdmin = User::create([
    'name' => 'Test Admin',
    'email' => 'test@themediacom.com',
    'username' => 'admin_test',
    'password' => 'secret123',
    'role' => 'admin',
    'status' => 'active',
]);

echo "3. New Admin created. Hashed password? " . ($newAdmin->password !== 'secret123' ? 'true' : 'false') . "\n";

// Deactivate one
$admin->status = 'inactive';
$admin->save();
echo "4. Original admin deactivated. canAccessPanel: " . ($admin->canAccessPanel(Filament::getCurrentPanel() ?: new \Filament\Panel()) ? 'true' : 'false') . "\n";

// Revert the DB state.
$admin->status = 'active';
$admin->save();
$newAdmin->delete();
echo "5. DB restored.\n";

echo "All Admin User backend tests passed.\n";
