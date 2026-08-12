<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            // Path of the logo waiting to go live
            $table->string('scheduled_logo')->nullable()->after('logo_image');
            // Exact datetime to swap the logo
            $table->dateTime('scheduled_logo_at')->nullable()->after('scheduled_logo');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['scheduled_logo', 'scheduled_logo_at']);
        });
    }
};
