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
        Schema::create('sms_settings', function (Blueprint $table) {
            $table->id();
            $table->string('gateway_name');
            $table->string('api_url');
            $table->string('api_key');
            $table->string('api_secret');
            $table->string('sender_id')->nullable();
            $table->string('request_type')->default('POST');
            $table->string('message_type')->default('TEXT');
            $table->longText('default_message')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_settings');
    }
};
