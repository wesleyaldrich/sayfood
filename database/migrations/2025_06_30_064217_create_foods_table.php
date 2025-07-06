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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->onUpdate('cascade')
            ->onDelete('set null');
            
            $table->foreignId('restaurant_id')
            ->nullable()
            ->constrained('restaurants')
            ->onUpdate('cascade')
            ->onDelete('set null');
            
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('stock')->nullable();
            $table->string('image_url')->nullable();
            $table->dateTime('exp_datetime')->nullable();
            $table->integer('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
