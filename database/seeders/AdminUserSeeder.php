<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists to avoid duplication errors
        if (!User::where('email', 'admin@motosell.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@motosell.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }
    }
}
