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
        Schema::create('manage_menu_items', function (Blueprint $table) {
             $table->id();
            $table->tinyInteger('category_status')->nullable();
            $table->tinyInteger('subcategory_status')->nullable();
            $table->tinyInteger('brand_status')->nullable();
            $table->tinyInteger('website_color_status')->nullable();
            $table->tinyInteger('user_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_menu_items');
    }
};
