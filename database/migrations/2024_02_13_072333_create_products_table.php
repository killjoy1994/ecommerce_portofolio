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
            $table->string('name');
            $table->string('small_description');
            $table->string('description');
            $table->string('slug');
            $table->string('brand')->nullable();
            $table->integer('price');
            $table->integer('quantity');
            $table->tinyInteger('trending')->default('0')->comment('0 = not trending, 1 = trending');
            $table->tinyInteger('featured')->default('0')->comment('0 = not featured, 1 = featured');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
