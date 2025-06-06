<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
      public function run(): void
    {
        // User::factory(10)->create();

        User::create([
        'name' => 'user',
        'email' => 'user@user.com',
        'password' => 'user123',
        'password' => Hash::make('user123'),
        ]);
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin123',
            'password' => Hash::make('admin123'),
        ]);
}}
