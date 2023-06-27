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
        Schema::create('launch', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->longText('url');
            $table->integer('launch_library_id')->nullable(true)->default(null);

            $table->string('slug');
            $table->string('name');

            $table->foreignUuid('status_id')->constrained('status');

            $table->string('net');
            $table->dateTime('window_end');
            $table->dateTime('window_start');

            $table->boolean('inhold')->nullable(true);
            $table->boolean('tbdtime')->nullable(true);
            $table->boolean('tbddate')->nullable(true);

            $table->double('probability')->nullable(true);

            $table->string('holdreason')->nullable(true);
            $table->string('failreason')->nullable(true);
            $table->string('hashtag')->nullable(true);

            $table->foreignUuid('provider_id')
                ->constrained('provider');

            $table->foreignUuid('rocket_id')->constrained('rocket');

            $table->foreignUuid('mission_id')->nullable(true)->constrained('mission');

            $table->foreignUuid('pad_id')->nullable(true)->constrained('pad');

            $table->boolean('webcast_live')->default(false);
            $table->string('image')->nullable(true);
            $table->string('infographic')->nullable(true);
            $table->string('program_id')->nullable(true)->default(null);

            $table->dateTime('imported_t')->nullable(true)->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('launch');
    }
};
