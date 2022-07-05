<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Module;
use App\Models\Fichier;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::pluck('id')->toArray();
        $module = Module::pluck('id')->toArray();
        return [
            'title' => $this->faker->title(),
            'id' => $this->faker->uuid,
            'public' => $this->faker->numberBetween(0, 1),
            'deleted' => $this->faker->numberBetween(0, 1),
            'fichier_id' =>  Fichier::factory(),
            'user_id' => $this->faker->randomElement($user),
            'module_id' => $this->faker->randomElement($module),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
