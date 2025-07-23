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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_id')->constrained('customers')->cascadeOnUpdate()->cascadeOnDelete();
            
            $table->foreignId('event_category_id')->constrained('event_categories')->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('name');
            $table->string('description');
            $table->string('image_url')->nullable();
            $table->date('date');
            $table->string('location');
            $table->enum('status',['Pending','Coming Soon','On Going','Completed','Canceled']);
            $table->string('group_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
