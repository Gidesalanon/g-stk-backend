<?php

namespace Database\Factories;

use App\Models\Documentation;
use App\Models\User;
use App\Models\Fichier;
use Illuminate\Database\Eloquent\Factories\Factory;

class FichierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fichier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'id' => $this->faker->uuid,
            'filename' => 'https://picsum.photos/id/'.rand(10,300).'/800/500'
        ];
    }
}
