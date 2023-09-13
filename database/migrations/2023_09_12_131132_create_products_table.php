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
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name');
            $table->string('description');
            $table->string('note')->nullable();
            $table->string('code_number');
            $table->string('image');
            $table->string('price');
            $table->string('viewed')->nullable()->default(0);
            $table->string('quantity');
            $table->boolean('is_active')->default(false);
            $table->bigInteger('brand_id');
            $table->bigInteger('category_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
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
