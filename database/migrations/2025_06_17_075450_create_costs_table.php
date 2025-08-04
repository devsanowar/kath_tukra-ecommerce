<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('branch')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('field_of_cost_id')->nullable();
            $table->text('description')->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('spend_by')->nullable();
            $table->timestamps();

//            // Foreign Keys
//            $table->foreign('category_id')->references('id')->on('cost_categories')->onDelete('cascade');
//            $table->foreign('field_of_cost_id')->references('id')->on('field_of_costs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs');
    }
};
