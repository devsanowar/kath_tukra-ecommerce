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
        Schema::table('website_colors', function (Blueprint $table) {
            $table->string('dark_color')->nullable();
            $table->string('white_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_colors', function (Blueprint $table) {
            $table->dropColumn('dark_color');
            $table->dropColumn('white_color');
        });
    }
};
