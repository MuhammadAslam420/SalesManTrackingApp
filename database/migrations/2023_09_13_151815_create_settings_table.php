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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('SalesmenTrackingApp');
            $table->string('google_map_api')->default('AIzaSyDKE74qyuQZ0ctAAZoEsLGjGQGf6XcE3PU');
            $table->string('logo')->default('sales.png');
            $table->string('copywrite')->default('Developed by MA');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
