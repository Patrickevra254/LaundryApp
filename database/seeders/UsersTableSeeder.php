<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // 🔥 1 Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
        ]);
        $superAdmin->assignRole('superAdmin');

        // 🔥 2 Admins
        for ($i = 1; $i <= 2; $i++) {
            $admin = User::create([
                'name' => "Admin $i",
                'email' => "admin$i@example.com",
                'password' => Hash::make('password'),
            ]);
            $admin->assignRole('admin');
        }

        // 🔥 2 Drivers
        for ($i = 1; $i <= 2; $i++) {
            $driver = User::create([
                'name' => "Staff $i",
                'email' => "staff$i@example.com",
                'password' => Hash::make('password'),
            ]);
            $driver->assignRole('staff');
        }

        // 🔥 5 Customers
        for ($i = 1; $i <= 5; $i++) {
            $customer = User::create([
                'name' => "Customer $i",
                'email' => "customer$i@example.com",
                'password' => Hash::make('password'),
            ]);
            $customer->assignRole('customer');
        }
    }
}
