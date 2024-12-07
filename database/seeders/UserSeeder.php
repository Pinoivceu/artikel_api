<?php

namespace Database\Seeders; // Pastikan namespace ini benar

use Illuminate\Database\Seeder; // Import Seeder
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Import Hash facade

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void // Tambahkan return type void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123')
        ]);
    }
}