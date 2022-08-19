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
            'qty' => $this->faker->numberBetween(1, 1000000000),
            'montant' => $this->faker->numberBetween(1, 1000000000000000),
            'public' => $this->faker->numberBetween(0, 1),
            'point' => $this->faker->numberBetween(0, 100),
            'type_price' => $this->faker->text,
            'description' => $this->faker->text,
            'fichier_id' =>  Fichier::factory(),
            'user_id' => $this->faker->randomElement($user),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
