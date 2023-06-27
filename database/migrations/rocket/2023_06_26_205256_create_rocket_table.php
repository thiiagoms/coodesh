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
        Schema::create('rocket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('rocket_id')->nullable(false);
            $table->foreignUuid('configuration_id')->constrained('configuration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rocket');
    }
};
