<?php

namespace Database\Seeders;

use App\Models\CategorieProduct;
use Illuminate\Database\Seeder;

class CategorieProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategorieProduct::factory()
        ->times(5)
            ->create();
    }
}
