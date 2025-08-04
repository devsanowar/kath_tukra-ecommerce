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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->nullable();
            $table->string('website_title')->nullable();
            $table->string('website_favicon')->nullable();
            $table->string('website_logo')->nullable();
            $table->string('website_footer_logo')->nullable();
            $table->string('website_footer_bg')->nullable();
            $table->string('website_footer_color')->nullable();
            $table->string('login_page_bg')->nullable();
            $table->string('login_page_bg_color')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('copyright_text')->nullable();
            $table->timestamps();
        });

        Schema::create('website_social_icon', function (Blueprint $table) {
            $table->id();
            $table->string('facbook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('pinterest_url')->nullable();
            $table->string('googleplus_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
        Schema::dropIfExists('website_social_icon');
    }
};
