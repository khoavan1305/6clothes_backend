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
            $table->id();

            $table->integer('brand_id')->unsigned();
            $table->integer('product_category_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->double('price');
            $table->double('discount')->nullable();
            $table->string('tag')->nullable();
            $table->boolean('featured')->default(0);
            $table->string('image');

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