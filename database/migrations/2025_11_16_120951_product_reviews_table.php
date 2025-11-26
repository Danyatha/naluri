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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id('id_review');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('id_product');
            $table->tinyInteger('rating')->comment('1-5');
            $table->text('review_text')->nullable();
            $table->timestamps();

            $table->foreign('id')
                ->references('id')->on('users')
                ->cascadeOnDelete();

            $table->foreign('id_product')
                ->references('id_product')->on('products')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
