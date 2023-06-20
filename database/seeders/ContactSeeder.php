<?php

namespace Database\Seeders;

use Database\Factories\ContactFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ContactFactory::times(50)->create();
    }
}
