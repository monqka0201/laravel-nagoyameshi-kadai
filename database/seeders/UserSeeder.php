<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ja_JP');

        foreach(range(1, 100) as $index) {
            User::create([
                'name' => $faker->name,
                'kana' => $faker->lastKanaName . ' '. $faker->firstKanaName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'postal_code' => $faker->postcode, 
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
            ]);
        }
    }
}
