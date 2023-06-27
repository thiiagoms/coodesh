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
        Schema::create('mission', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->integer('mission_id')->nullable(false);
            $table->integer('launch_library_id')->nullable(true)->default(null);
            $table->foreignUuid('orbit_id')->constrained('orbit')->onDelete('cascade');

            $table->string('name');
            $table->longText('description');
            $table->string('launch_designator')->nullable(true)->default(null);
            $table->string('type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission');
    }
};
