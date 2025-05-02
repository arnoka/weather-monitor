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
        Schema::create('weather_queries', function (Blueprint $table) {
            $table->id();
            $table->float('latitude');
            $table->float('longitude');
            $table->float('generationtime_ms');
            $table->integer('utc_offset_seconds');
            $table->string('timezone');
            $table->string('timezone_abbreviation');
            $table->float('elevation');
            $table->morphs('queryable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_queries');
    }
};
