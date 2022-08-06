<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin sir',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        \App\Models\Role::create([
            'id' => 1,
            'name' => 'admin',
        ]);

        \App\Models\Role::create([
            'id' => 2,
            'name' => 'customer',
        ]);

        \App\Models\Role::create([
            'id' => 3,
            'name' => 'candidate',
        ]);
    }
}
