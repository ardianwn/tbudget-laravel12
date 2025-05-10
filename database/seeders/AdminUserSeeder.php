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
            'name' => 'Admin',
            'email' => 'admin@tbudget.com',
            'password' => Hash::make('password'),
            'is_admin' => true
        ]);

        // Tambahkan user biasa untuk testing
        User::create([
            'name' => 'User',
            'email' => 'user@tbudget.com',
            'password' => Hash::make('password'),
            'is_admin' => false
        ]);
    }
} 