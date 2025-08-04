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
        Schema::create('home_abouts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->text('list_one')->nullable();
            $table->text('list_two')->nullable();
            $table->text('list_three')->nullable();
            $table->text('list_four')->nullable();
            $table->text('list_five')->nullable();
            $table->text('list_six')->nullable();
            $table->text('list_seven')->nullable();
            $table->text('list_eight')->nullable();
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_abouts');
    }
};
