<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // return [
            //'id' => $this->faker->uuid,
        //     'lastname' => $this->faker->lastName,
        //     'firstname' => $this->faker->firstName,
        //     'username' => $this->faker->name,
        //     'public' => rand(0,1),
        //     'email' => $this->faker->unique()->safeEmail,
        //     //'email_verified_at' => now(),
        //     'password' => bcrypt('password'), // password
        //     //'remember_token' => Str::random(10),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];
    }
}
