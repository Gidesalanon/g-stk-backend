<?php

namespace Database\Factories;

use App\Models\Projet;
use App\Models\Fichier;
use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Projet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = [
            "-1", "0", "1"
        ];
        $module = Module::pluck('id')->toArray();
        $user = User::pluck('id')->toArray();
        return [
            'id' => $this->faker->uuid,
            'nom' => $this->faker->name,
            'financeur' => $this->faker->name,
            'public' => $this->faker->numberBetween(0, 1),
            'status' => $types[rand(0, 2)],
            'fin' => $this->faker->date,
            'debut' => $this->faker->date,
            'montant' => $this->faker->numberBetween(1000000, 9000000000),
            'taux_execution' => $this->faker->numberBetween(0, 100),
            'module_id' => $this->faker->randomElement($module),
            'user_id' => $this->faker->randomElement($user),
            'description' => $this->faker->text,
            'fichier_id' =>  Fichier::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
