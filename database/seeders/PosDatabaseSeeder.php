<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PosDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 5 sample customers
        $customers = [
            ['full_name' => 'Miguel Pardo', 'email' => 'miguel@example.com', 'phone' => '111-1111'],
            ['full_name' => 'Bob Jones', 'email' => 'bob@example.com', 'phone' => '555-0102'],
            ['full_name' => 'Charlie Brown', 'email' => 'charlie@example.com', 'phone' => '555-0103'],
            ['full_name' => 'Diana Prince', 'email' => 'diana@example.com', 'phone' => '555-0104'],
            ['full_name' => 'Ethan Hunt', 'email' => 'ethan@example.com', 'phone' => '555-0105'],
        ];

        foreach ($customers as $customer) {
            Customer::updateOrCreate(['email' => $customer['email']], $customer);
        }

        // 5 sample users (demo password for local testing: "password")
        $users = [
            ['username' => 'asmith', 'full_name' => 'Alice Smith', 'email' => 'alice@example.com'],
            ['username' => 'bjones', 'full_name' => 'Bob Jones', 'email' => 'bob@example.com'],
            ['username' => 'cbrown', 'full_name' => 'Charlie Brown', 'email' => 'charlie@example.com'],
            ['username' => 'dprince', 'full_name' => 'Diana Prince', 'email' => 'diana@example.com'],
            ['username' => 'ehunt', 'full_name' => 'Ethan Hunt', 'email' => 'ethan@example.com'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user + ['password' => Hash::make('password')],
            );
        }
    }
}
