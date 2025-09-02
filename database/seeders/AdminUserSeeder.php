<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'SENA Admin',
            'email' => 'admin@sena.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Customer Service 1',
            'email' => 'cs1@sena.com',
            'password' => Hash::make('cs123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}
