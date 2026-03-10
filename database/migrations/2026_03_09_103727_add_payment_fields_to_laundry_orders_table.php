<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laundry_orders', function (Blueprint $table) {

            if (!Schema::hasColumn('laundry_orders', 'payment_method')) {
                $table->string('payment_method')->default('cash')->after('status');
            }

            if (!Schema::hasColumn('laundry_orders', 'payment_timing')) {
                $table->string('payment_timing')->default('on_collection')->after('payment_method');
            }

            if (!Schema::hasColumn('laundry_orders', 'payment_status')) {
                $table->string('payment_status')->default('pending')->after('payment_timing');
            }

            if (!Schema::hasColumn('laundry_orders', 'amount_paid')) {
                $table->integer('amount_paid')->default(0)->after('payment_status');
            }

            if (!Schema::hasColumn('laundry_orders', 'paystack_reference')) {
                $table->string('paystack_reference')->nullable()->after('amount_paid');
            }
        });
    }

    public function down(): void
    {
        Schema::table('laundry_orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_timing',
                'payment_status',
                'amount_paid',
                'paystack_reference',
            ]);
        });
    }
};
