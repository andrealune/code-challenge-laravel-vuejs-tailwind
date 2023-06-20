<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'name'      => 'test',
            'email'     => 'test@test.com',
            'password'  => bcrypt('test1234')
        ]);

        $user = User::create([
            'name'      => 'admin',
            'email'     => 'admin@test.com',
            'password'  => bcrypt('test1234'),
            'role_id'   => 2
        ]);
    }
}
