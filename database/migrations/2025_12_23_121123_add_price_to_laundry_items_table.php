<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up()
    // {
    //     Schema::table('laundry_items', function (Blueprint $table) {
    //         $table->decimal('price', 10, 2)->after('category_id');
    //     });
    // }

    public function up(): void
    {
        Schema::table('laundry_items', function (Blueprint $table) {
            if (!Schema::hasColumn('laundry_items', 'price')) {
                $table->decimal('price', 10, 2)->after('category_id');
            }
        });
    }

    public function down()
    {
        Schema::table('laundry_items', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
};
