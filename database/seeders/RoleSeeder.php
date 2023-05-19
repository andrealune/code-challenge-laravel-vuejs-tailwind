<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = collect([
            [
                "description"     => "Administrador",
            ],
            [
                "description"     => "Usuario",
            ],
        ]);
        $fields->each(function ($field){
            Role::updateOrCreate([
                "description" => $field["description"]
            ],$field);
        });
    }
}
