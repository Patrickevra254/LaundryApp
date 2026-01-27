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
        Schema::table('laundry_items', function (Blueprint $table) {
            $table->decimal('washing_price', 10, 2)->default(0)->after('price');
            $table->decimal('ironing_price', 10, 2)->default(0)->after('washing_price');
            $table->decimal('wash_and_iron_price', 10, 2)->default(0)->after('ironing_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laundry_items', function (Blueprint $table) {
            $table->dropColumn(['washing_price', 'ironing_price', 'wash_and_iron_price']);
        });
    }
};
