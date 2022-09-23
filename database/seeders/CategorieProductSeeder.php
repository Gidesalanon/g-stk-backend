<?php

namespace Database\Seeders;

use App\Models\CategorieProduct;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategorieProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::pluck('id')->toArray();
        $category = CategorieProduct::firstOrCreate([
            'name' => 'SERVIETTES HYGIÉNIQUE',
          ], [
            'id' => (string) Str::uuid(),
            'description'=>'SERVIETTES HYGIÉNIQUE',
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $category = CategorieProduct::firstOrCreate([
            'name' => 'SOINS DE SANTÉ',
          ], [
            'id' => (string) Str::uuid(),
            'description'=>'SOINS DE SANTÉ',
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $category = CategorieProduct::firstOrCreate([
            'name' => 'SOINS DE SANTÉ HIGH-TECH',
          ], [
            'id' => (string) Str::uuid(),
            'description'=>'SOINS DE SANTÉ HIGH-TECH',
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $category = CategorieProduct::firstOrCreate([
            'name' => 'USAGE COMMUN ET ACCESSOIRES',
          ], [
            'id' => (string) Str::uuid(),
            'description'=>'USAGE COMMUN ET ACCESSOIRES',
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
