<?php

namespace Database\Factories;

use App\Models\Entreprise;
use App\Models\User;
use App\Models\Module;
use App\Models\Fichier;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entreprise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $user = User::pluck('id')->toArray();
        return [
            'id' => $this->faker->uuid,
            'name' => $this->faker->company,
            'public' => $this->faker->numberBetween(0, 1),
            'presentation' => $this->faker->text,
            'fichier_id' =>  Fichier::factory(),
            'user_id' => $this->faker->randomElement($user),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
