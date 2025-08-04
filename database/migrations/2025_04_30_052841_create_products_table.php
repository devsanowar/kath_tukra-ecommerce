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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained('sub_categories')->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');

            $table->string('product_name');
            $table->string('product_slug')->unique();
            $table->string('sku')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();

            $table->decimal('regular_price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->enum('discount_type', ['flat', 'percent'])->nullable();

            $table->integer('stock_quantity')->default(0);
            $table->boolean('in_stock')->default(true);

            $table->json('colors')->nullable();
            $table->json('sizes')->nullable();

            $table->string('thumbnail')->nullable();
            $table->json('images')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
