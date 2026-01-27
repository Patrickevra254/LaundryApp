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
        Schema::create('laundry_order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laundry_order_id')
                ->constrained('laundry_orders')
                ->cascadeOnDelete();

            $table->string('item_name');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('subtotal');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_order_items');
    }
};
