<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prepare user data
        $user = [
            'name' => 'Admin',
            'email' => 'admin@mailinator.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert user data
        User::insert($user);
    }
}
