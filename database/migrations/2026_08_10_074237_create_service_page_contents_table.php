<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('btl_metric_reached')->nullable()->default('5M+');
            $table->string('btl_metric_malls')->nullable()->default('200+');
            $table->string('btl_metric_locations')->nullable()->default('50+');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_page_contents');
    }
};
