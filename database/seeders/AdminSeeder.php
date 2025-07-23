<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['password' => Hash::make('nagoyameshi')]
        );

        Admin::firstOrCreate(
            ['email' => 'admin2@example.com'],
            ['password' => Hash::make('nagoyameshi2')]
        );
    }
}
