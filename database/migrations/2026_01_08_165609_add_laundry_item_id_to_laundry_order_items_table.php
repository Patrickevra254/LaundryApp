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
            $table->unsignedBigInteger('laundry_item_id')->after('id');
            // optionally, add a foreign key constraint if you have a laundry_items table
            // $table->foreign('laundry_item_id')->references('id')->on('laundry_items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('laundry_order_items', function (Blueprint $table) {
            $table->dropColumn('laundry_item_id');
        });
    }
};
