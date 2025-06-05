<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => "ADMINISTRATOR",
                'email' => 'Administrator@gmail.com',
                'password' => Hash::make('admin'),
            ],
            [
                'name' => "Admin 2",
                'email' => 'AdminAcc2@gmail.com',
                'password' => Hash::make('Admin2'),
            ],
            [
                'name' => "User Admin",
                'email' => 'UserAdmin@gmail.com',
                'password' => Hash::make('Admin123'),
            ],
        ]);
    }
}
