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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('percentage'); // Assuming percentage can have up to 5 digits in total with 2 decimal places
            $table->boolean('valid')->default(true); // Assuming valid by default
            $table->string('website_url')->nullable();
            $table->string('sku')->nullable();
            $table->boolean('is_hidden')->default(false); // Assuming whether to show or hide by default
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->integer('usage_limit')->nullable(); // Assuming how many times the coupon can be used, null for unlimited
            $table->integer('price')->nullable(); // Assuming price can have up to 10 digits in total with 2 decimal places, nullable for non-monetized coupons
            $table->string('image')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')
                ->references('id')
                ->on('stores');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')
            ->references('id')
            ->on('brands');
            $table->date('start_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
