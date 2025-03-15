<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Admin pertama
        Admin::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
            ]
        );

        // Admin tambahan
        Admin::updateOrCreate(
            ['email' => 'admin2@example.com'],
            [
                'name' => 'Admin 2',
                'password' => Hash::make('password456'),
            ]
        );
    }
}
