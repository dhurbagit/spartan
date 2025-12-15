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
        Schema::create('sister_companies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image_one')->nullable();
            $table->string('cover_image_two')->nullable();
            $table->string('cover_title_one')->nullable();
            $table->string('cover_title_two')->nullable();
            $table->string('link_one')->nullable();
            $table->string('link_two')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sister_companies');
    }
};
