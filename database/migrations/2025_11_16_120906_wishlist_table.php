<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Symfony\Component\String\s;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->bigIncrements('id_wishlist');

            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('id_product');

            $table->timestamps();

            // Unique constraint: 1 user tidak bisa wishlist produk yang sama dua kali
            $table->unique(['id', 'id_product']);

            // Foreign Keys harus match tipe dan unsigned-nya
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
        Schema::dropIfExists('wishlists');
    }
};
