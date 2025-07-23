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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers', 'id')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants', 'id')->nullOnDelete()->cascadeOnUpdate();
            $table->text('description');
            $table->enum('status', ['Pending', 'Resolved'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
