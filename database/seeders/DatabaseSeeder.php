<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = [
            // Super Admin
            [
                'username'      => 'superadmin',
                'email'         => 'superadmin@example.com',
                'password'      => Hash::make('password'),
                'first_name'    => 'Super',
                'middle_name'  => 'Admin',
                'last_name'    => 'System',
                'gender'       => 'male',
                'phone'         => '1234567890',
                'role'         => 'superadmin',
                'is_active'    => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],

            // Admin
            [
                'username'      => 'admin',
                'email'         => 'admin@example.com',
                'password'      => Hash::make('password'),
                'first_name'    => 'John',
                'middle_name'  => 'Doe',
                'last_name'    => 'Admin',
                'gender'       => 'male',
                'phone'         => '9876543210',
                'role'         => 'admin',
                'is_active'    => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],

            // Manager
            [
                'username'      => 'manager',
                'email'         => 'manager@example.com',
                'password'      => Hash::make('password'),
                'first_name'    => 'Alice',
                'middle_name'  => 'M',
                'last_name'    => 'Manager',
                'gender'       => 'female',
                'phone'         => '5551234567',
                'role'         => 'manager',
                'is_active'    => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],

            // Staff
            [
                'username'      => 'staff',
                'email'         => 'staff@example.com',
                'password'      => Hash::make('password'),
                'first_name'    => 'Bob',
                'middle_name'  => 'S',
                'last_name'    => 'Staff',
                'gender'       => 'male',
                'phone'         => '4445556666',
                'role'         => 'staff',
                'is_active'    => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],

            // Customer
            [
                'username'      => 'customer',
                'email'         => 'customer@example.com',
                'password'      => Hash::make('password'),
                'first_name'    => 'Emma',
                'middle_name'  => 'C',
                'last_name'    => 'Customer',
                'gender'       => 'female',
                'phone'         => '3332221111',
                'role'         => 'customer',
                'is_active'    => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}