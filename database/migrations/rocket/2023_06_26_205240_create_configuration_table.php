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
        Schema::create('configuration', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('configuration_id')->nullable(false);
            $table->integer('launch_library_id')->nullable(true)->default(null);
            $table->string('url');
            $table->string('name');
            $table->string('family');
            $table->string('full_name');
            $table->string('variant');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration');
    }
};
