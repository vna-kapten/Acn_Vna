<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ThriftUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@thrift.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Regular users
        User::factory(10)->create([
            'role' => 'user',
        ]);
    }
}
