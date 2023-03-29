<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $users = [
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('password'),
                'is_admin'=>1
            ],
            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'password'=>bcrypt('password'),
                'is_admin'=>0
            ]

        ];

        DB::table('users')->insert($users);
    }
}
