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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('title');
            $table->string('category', 100);
            $table->string('image');
            $table->text('problem')->nullable();
            $table->text('solution')->nullable();
            $table->text('result')->nullable();
            $table->string('metrics_1_val', 50)->nullable();
            $table->string('metrics_1_label', 100)->nullable();
            $table->string('metrics_2_val', 50)->nullable();
            $table->string('metrics_2_label', 100)->nullable();
            $table->boolean('featured')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
