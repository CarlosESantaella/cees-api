<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // CREATE PROFILE SUPER ADMIN
        \App\Models\Profile::factory()->create([
            'name' => 'Super Admin',
            'permissions' => [
                'MANAGE USERS' => "All",
                'MANAGE PROFILES' => "All",
                'MANAGE REQUEST' => "All",
                "MANAGE SERVICES" => "All",
                "MANAGE DIAGNOSES AND QUOTES" => "All",
                "MANAGE INVENTORY" => "All",
                "MANAGE ORDERS" => "All",
                "MANAGE CONFIGURATION" => "All",
            ]
        ]);

        // CREATE PROFILE ADMIN
        \App\Models\Profile::factory()->create([
            'name' => 'Admin',
            'permissions' => [
                'MANAGE USERS' => "Own",
                'MANAGE PROFILES' => "None",
                'MANAGE REQUEST' => "Own",
                "MANAGE SERVICES" => "Own",
                "MANAGE DIAGNOSES AND QUOTES" => "Own",
                "MANAGE INVENTORY" => "Own",
                "MANAGE ORDERS" => "Own",
                "MANAGE CONFIGURATION" => "Own",
            ]
        ]);

        // CREATE USER ADMIN
        \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => '123123',
            'profile' => 1
        ]);
    }
}
