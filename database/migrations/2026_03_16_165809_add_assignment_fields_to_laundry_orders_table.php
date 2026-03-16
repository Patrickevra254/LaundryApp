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
        Schema::table('laundry_orders', function (Blueprint $table) {
            $table->string('wash_assigned_to')->nullable();
            $table->string('iron_assigned_to')->nullable();
            $table->integer('extra_charges')->default(0);
            $table->string('extra_charges_note')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('laundry_orders', function (Blueprint $table) {
            $table->dropColumn(['wash_assigned_to', 'iron_assigned_to', 'extra_charges', 'extra_charges_note']);
        });
    }
};
