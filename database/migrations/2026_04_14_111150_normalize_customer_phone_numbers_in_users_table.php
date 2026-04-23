<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::table('users')
            ->orderBy('id')
            ->chunkById(100, function ($users) {

                foreach ($users as $user) {

                    if (!$user->phone) continue;

                    // Remove non-digits
                    $phone = preg_replace('/\D/', '', $user->phone);

                    if (!$phone) continue;

                    // Convert 234 → 0
                    if (str_starts_with($phone, '234')) {
                        $phone = '0' . substr($phone, 3);
                    }

                    // Ensure it starts with 0
                    if (!str_starts_with($phone, '0')) {
                        $phone = '0' . $phone;
                    }

                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['phone' => $phone]);
                }
            });
    }

    public function down()
    {
        // Not safely reversible
    }
};
