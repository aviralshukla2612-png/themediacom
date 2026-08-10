<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$u = User::first();
if(!$u){
    $u = new User();
    $u->username='admin';
}
$u->name='Admin';
$u->email='admin@themediacom.com';
$u->password=Hash::make('password');
$u->save();
echo 'Email: ' . $u->email;
