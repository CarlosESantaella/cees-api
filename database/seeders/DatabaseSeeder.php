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
                'MANAGE USERS' => "ALL",
                'MANAGE CLIENTS' => "NONE",
                'MANAGE PROFILES' => "ALL",
                'MANAGE REQUEST' => "NONE",
                "MANAGE SERVICES" => "NONE",
                "MANAGE DIAGNOSES" => "NONE",
                "MANAGE FAILURE MODES" => "NONE",
                "MANAGE INVENTORY" => "NONE",
                "MANAGE ORDERS" => "NONE",
                "MANAGE CONFIGURATIONS" => "NONE",
                "MANAGE ITEMS" => "NONE",
            ]
        ]);

        // CREATE PROFILE ADMIN
        $admin = \App\Models\Profile::factory()->create([
            'name' => 'Admin',
            'permissions' => [
                'MANAGE USERS' => "OWN",
                'MANAGE CLIENTS' => "OWN",
                'MANAGE PROFILES' => "OWN",
                'MANAGE REQUEST' => "OWN",
                "MANAGE SERVICES" => "OWN",
                "MANAGE DIAGNOSES" => "OWN",
                "MANAGE FAILURE MODES" => "OWN",
                "MANAGE INVENTORY" => "OWN",
                "MANAGE ORDERS" => "OWN",
                "MANAGE CONFIGURATIONS" => "OWN",
                "MANAGE RECEPTIONS" => "OWN",
                "MANAGE RATES" => "OWN",
                "MANAGE ITEMS" => "OWN",
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
