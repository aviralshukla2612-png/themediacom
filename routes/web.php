<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InquiryController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/corporate', [PageController::class, 'corporate'])->name('corporate');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/ai', [PageController::class, 'ai'])->name('ai');

// Redirect legacy .php URLs
Route::redirect('/contact.php', '/contact', 301);

// Default legacy route if needed, else points to index
Route::get('/default', [PageController::class, 'index'])->name('default');

// Contact Form Submission
Route::post('/contact/submit', [InquiryController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('inquiry.store');

// Temporary route to fix the storage symlink on production (Hostinger)
Route::get('/fix-storage', function () {
    try {
        Illuminate\Support\Facades\Artisan::call('storage:link');
        return 'Storage link created successfully. Check your logo now!';
    } catch (\Exception $e) {
        return 'Error creating storage link: ' . $e->getMessage();
    }
});
