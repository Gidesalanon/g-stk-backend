<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\CategorieProduct;
use App\Models\User;
use App\Models\Fichier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $user = User::pluck('id')->toArray();
      $categorie = CategorieProduct::pluck('id')->toArray();
        return [
            'id' => $this->faker->uuid,
            'name' => $this->faker->name,
            'public' => $this->faker->numberBetween(0, 1),
            'description' => $this->faker->text,
            'expiration_date' => $this->faker->date,
            'fichier_id' =>  Fichier::factory(),
            'user_id' => $this->faker->randomElement($user),
            'categorie_id' => $this->faker->randomElement($categorie),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
