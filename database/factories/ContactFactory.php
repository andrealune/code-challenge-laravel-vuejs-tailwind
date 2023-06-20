<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{

    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   
        $faker = Faker::create();

        return [
            'first_name' => $faker->firstName,
            'last_name'  => $faker->lastName,
            'phone'      => $faker->phoneNumber,
            'email'      => $faker->email,
        ];
    }
}
