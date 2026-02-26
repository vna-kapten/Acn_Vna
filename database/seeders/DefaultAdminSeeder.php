<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Str;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists to avoid duplication
        if (!User::where('email', 'admin@thrift.com')->exists()) {
            User::create([
                'id' => Str::uuid(),
                'name' => 'Admin Thrift',
                'email' => 'admin@thrift.com',
                'password' => Hash::make('password123'), // Default password
                'role' => 'admin',
            ]);
            $this->command->info('Default Admin user created: admin@thrift.com / password123');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
