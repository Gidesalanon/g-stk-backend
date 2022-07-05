<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            $types = [
            'SUPERADMIN',
            'ADMIN',
            'DATA_MANAGER'        ];
        return [
            'name' => $types[rand(0, 2)],
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
