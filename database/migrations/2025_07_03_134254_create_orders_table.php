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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('restaurant_id')->constrained('restaurants');

            $table->enum('status', [
                'Order Created',
                'Order Accepted',
                'In Progress',
                'Ready to Pickup',
                'Order Completed',
                'Order Reviewed'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
