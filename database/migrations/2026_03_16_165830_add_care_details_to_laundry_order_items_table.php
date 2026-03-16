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
        Schema::table('laundry_order_items', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->text('observations')->nullable();
            $table->text('requirements')->nullable();
            $table->enum('starch_level', ['none', 'low', 'medium', 'high'])->default('medium');
            $table->enum('heat_level', ['low', 'medium', 'high'])->default('medium');
            $table->enum('finish', ['folded', 'hanged'])->default('folded');
            $table->integer('extra_charge')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('laundry_order_items', function (Blueprint $table) {
            $table->dropColumn(['description', 'observations', 'requirements', 'starch_level', 'heat_level', 'finish', 'extra_charge']);
        });
    }
};
