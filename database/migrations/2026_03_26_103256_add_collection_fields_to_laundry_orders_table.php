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
            $table->string('packed_by')->nullable()->after('iron_assigned_to');
            $table->string('reviewed_by')->nullable()->after('packed_by');
            $table->string('collector_name')->nullable()->after('reviewed_by');
            $table->string('collector_phone')->nullable()->after('collector_name');
            $table->date('collection_date')->nullable()->after('collector_phone');
        });
    }

    public function down(): void
    {
        Schema::table('laundry_orders', function (Blueprint $table) {
            $table->dropColumn([
                'packed_by',
                'reviewed_by',
                'collector_name',
                'collector_phone',
                'collection_date'
            ]);
        });
    }
};
