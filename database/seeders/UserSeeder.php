<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Insert a single admin user
        DB::table('users')->insert([
            'name' => 'Admin', // Admin's name
            'email' => 'admin@admin.com', // Admin's email
            'password' => Hash::make('12345678'), // Admin's password (hashed)
            'user_type'=>1,
            'created_at' => now(), // Current timestamp
            'updated_at' => now(), // Current timestamp
        ]);
    }
}
