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
                'MANAGE USERS' => "ALL"
            ]
        ]);

        // CREATE PROFILE ADMIN
        $admin = \App\Models\Profile::factory()->create([
            'name' => 'Admin',
            'permissions' => [
                'MANAGE USERS' => "OWN",
                'MANAGE PROFILES' => "OWN"
            ]
        ]);

        // CREATE USER ADMIN
        $user = \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'username' => 'superadmin',
            'email' => 'john.doe@gmail.com',
            'password' => '123456',
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
