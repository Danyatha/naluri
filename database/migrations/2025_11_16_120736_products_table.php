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
            $table->bigIncrements('id_product');

            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->integer('stock')->default(0);

            $table->unsignedBigInteger('id_category');   // WAJIB cocok
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('id_category')
                ->references('id_category')->on('categories')
                ->cascadeOnDelete();

            $table->foreign('updated_by')
                ->references('id_admin')->on('admins')
                ->nullOnDelete();
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
