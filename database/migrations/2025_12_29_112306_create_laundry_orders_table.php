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
        Schema::create('laundry_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();

            $table->text('pickup_address');
            $table->text('delivery_address');

            $table->date('pickup_date');
            $table->date('delivery_date');

            $table->string('service_type'); // standard, express

            $table->integer('total_items')->default(0);
            $table->integer('subtotal')->default(0);
            $table->integer('service_fee')->default(0);
            $table->integer('total_amount')->default(0);

            $table->string('status')->default('pending');

            $table->foreignId('created_by')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_orders');
    }
};
