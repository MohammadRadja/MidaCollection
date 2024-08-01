<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('@Admin123'),
                'role' => 'admin',
                'address' => 'Tangerang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('@User123'),
                'role' => 'user',
                'address' => 'Tangerang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
