<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fichier;

class FichierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fichier::factory()
        ->times(10)
        ->create();
    }
}
