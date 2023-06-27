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
        Schema::create('location', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('location_id')->nullable(false);
            $table->string('url');
            $table->string('name');
            $table->string('country_code');
            $table->string('map_image');
            $table->integer('total_launch_count');
            $table->integer('total_landing_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location');
    }
};
