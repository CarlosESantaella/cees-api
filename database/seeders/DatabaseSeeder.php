<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // CREATE PROFILE SUPER ADMIN
        $super_admin = \App\Models\Profile::factory()->create([
            'name' => 'Super Admin',
            'permissions' => [
                'MANAGE USERS' => "All",
                'MANAGE CLIENTS' => "None",
                'MANAGE PROFILES' => "All",
                'MANAGE REQUEST' => "None",
                "MANAGE SERVICES" => "None",
                "MANAGE DIAGNOSES AND QUOTES" => "None",
                "MANAGE INVENTORY" => "None",
                "MANAGE ORDERS" => "None",
                "MANAGE CONFIGURATIONS" => "None",
                "MANAGE ITEMS" => "None",
            ]
        ]);

        // CREATE PROFILE ADMIN
        $admin = \App\Models\Profile::factory()->create([
            'name' => 'Admin',
            'permissions' => [
                'MANAGE USERS' => "Own",
                'MANAGE CLIENTS' => "Own",
                'MANAGE PROFILES' => "Own",
                'MANAGE REQUEST' => "Own",
                "MANAGE SERVICES" => "Own",
                "MANAGE DIAGNOSES AND QUOTES" => "Own",
                "MANAGE INVENTORY" => "Own",
                "MANAGE ORDERS" => "Own",
                "MANAGE CONFIGURATIONS" => "Own",
                "MANAGE RECEPTIONS" => "Own",
                "MANAGE RATES" => "Own",
                "MANAGE ITEMS" => "Own",
            ]
        ]);

        // CREATE USER ADMIN
        $user = \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'username' => 'superadmin',
            'email' => 'john.doe@gmail.com',
            'password' => '123123',
            'profile' => 1
        ]);

        // UPDATE PROFILE SUPER ADMIN AND ADMIN
        Profile::find($super_admin->id)->update([
            'user_id' => $user->id
        ]);
        Profile::find($admin->id)->update([
            'user_id' => $user->id
        ]);

    }
}
