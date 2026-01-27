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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laundry_order_id')->constrained()->onDelete('cascade');
            $table->string('reference')->unique(); // Paystack transaction reference
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->decimal('amount', 10, 2); // e.g. 1000.00
            $table->string('currency')->default('NGN');
            $table->text('meta')->nullable(); // store full Paystack response if needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
