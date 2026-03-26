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
            $table->unsignedInteger('due_days')->default(1)->after('wash_and_iron_price');
        });
    }

    public function down(): void
    {
        Schema::table('laundry_items', function (Blueprint $table) {
            $table->dropColumn('due_days');
        });
    }
};
