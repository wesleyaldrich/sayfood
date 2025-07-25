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
            $table->foreignId(column: 'customer_id')->nullable()->constrained(table: 'users', column: 'id')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId(column: 'restaurant_id')->nullable()->constrained(table: 'restaurants', column: 'id')->nullOnDelete()->cascadeOnUpdate();
            $table->text(column: 'description');
            $table->enum(column: 'status', allowed: ['Pending', 'Resolved'])->default(value: 'Pending');
            $table->text(column: 'note')->nullable();
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
