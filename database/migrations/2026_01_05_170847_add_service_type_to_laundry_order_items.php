<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('laundry_order_items', function (Blueprint $table) {
            $table->enum('service_type', ['washing', 'ironing', 'wash_and_iron'])->after('item_name');
        });
    }

    public function down()
    {
        Schema::table('laundry_order_items', function (Blueprint $table) {
            $table->dropColumn('service_type');
        });
    }
};
