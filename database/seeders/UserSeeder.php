<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'fairus',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'jaya',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);

        // Create additional test users
        User::factory()->count(10)->create();
    }
}
