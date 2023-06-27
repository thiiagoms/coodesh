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
        Schema::create('pad', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('pad_id')->nullable(false);
            $table->string('url');
            $table->integer('agency_id')->nullable(true);
            $table->string('name');
            $table->string('info_url')->nullable(true);
            $table->string('wiki_url')->nullable(true);
            $table->string('map_url')->nullable(true);
            $table->string('latitude');
            $table->string('longitude');
            $table->foreignUuid('location_id')->constrained('location')->onDelete('cascade');
            $table->string('map_image');
            $table->integer('total_launch_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pad');
    }
};
