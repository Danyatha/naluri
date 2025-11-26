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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id('id_log');
            $table->unsignedBigInteger('id_admin');
            $table->string('action');              // create / update / delete
            $table->string('entity');              // product / category / image
            $table->unsignedBigInteger('entity_id');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('id_admin')
                ->references('id_admin')->on('admins')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
