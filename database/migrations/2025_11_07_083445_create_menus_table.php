<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->string('category_slug');
            $table->integer('position');
            $table->boolean('main_child');
            $table->integer('parent_id')->nullable();
            $table->integer('header_footer');
            $table->boolean('status')->default(1);
            $table->string('bannerImage')->nullable();
            $table->string('image')->nullable();
            $table->string('page_title')->nullable();
            $table->text('title_slug')->nullable();
            $table->longText('content')->nullable();
            $table->longText('description')->nullable();
            $table->string('external_link')->nullable();
            $table->longText('metaTitle')->nullable();
            $table->longText('metaKeyword')->nullable();
            $table->longText('metaDescription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
