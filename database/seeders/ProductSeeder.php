<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CategorieProduct;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::pluck('id')->toArray();
        $categorie = CategorieProduct::whereName('USAGE COMMUN ET ACCESSOIRES')->first();
        $product = Product::firstOrCreate([
            'name' => 'Deodorant Roll On',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 3.5,
            'partner_price' => 2600,
            'client_price' => 3000,
            'description' => 'Deodorant Roll On (50ml)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Parfum de Bouche',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 2.2,
            'partner_price' => 1800,
            'client_price' => 2100,
            'description' => 'Parfum de Bouche (15g)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Gel Douche',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 6,
            'partner_price' => 4900,
            'client_price' => 5500,
            'description' => 'Gel Douche (300ml)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Savon Noir',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 5,
            'partner_price' => 4300,
            'client_price' => 4800,
            'description' => 'Savon Noir Au Charbon de Bambou et aux Essences Naturelles',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Shampooing 2en1',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 6,
            'partner_price' => 4900,
            'client_price' => 5500,
            'description' => 'Shampooing 2en1 (300ml)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => ' Lait de Corps SOD',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 3.2,
            'partner_price' => 3300,
            'client_price' => 3000,
            'description' => 'Lait de Corps a base de Placenta de Brebis (200ml)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Pâtte Artemisin',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 2,
            'partner_price' => 3500,
            'client_price' => 4000,
            'description' => 'Pâtte Artemisin (200g)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Pâtte Dentifrice (200g)',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 3.5,
            'partner_price' => 3000,
            'client_price' => 3500,
            'description' => 'Pâtte Dentifrice au Thé Blanc (200g)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Pâtte Dentifrice (100g)',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 1.2,
            'partner_price' => 1700,
            'client_price' => 2000,
            'description' => 'Pâtte Dentifrice au Thé Blanc (100g)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Anti-Moustiques',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 4,
            'partner_price' =>3200,
            'client_price' => 3700,
            'description' => 'Eau de Toilette Anti-Moustiques(Arôme de Fleurs et Fruits) (195ml)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Crème à Main',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 3.5,
            'partner_price' => 2700,
            'client_price' => 3200,
            'description' => 'Crème à Main Réparatrice Q10 (100g)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Snake Oil',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 2,
            'partner_price' => 1800,
            'client_price' => 2500,
            'description' => 'Snake Oil',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Lait rajeunissant',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 3,
            'partner_price' => 3600,
            'client_price' => 4000,
            'description' => 'Lotion Rejuvenating 165ml',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Bebe Lait corporel',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 3,
            'partner_price' => 2800,
            'client_price' => 3200,
            'description' => 'Bebe Lait corporel',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Bebe 2en1 Shampoing et gel douche',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 6,
            'partner_price' => 4900,
            'client_price' => 5200,
            'description' => 'Bebe 2en1 Shampoing et gel douche',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Bebe Couche energetique',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 2,
            'partner_price' => 6900,
            'client_price' => 7200,
            'description' => 'Bebe Couche energetique taille S, M, L, XL',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Power Bank',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 10,
            'partner_price' => 15500,
            'client_price' => 19500,
            'description' => 'Power Bank',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Câble chargeur',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 5,
            'partner_price' => 5000,
            'client_price' => 6000,
            'description' => 'Câble chargeur',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Kit de voyages',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 2,
            'partner_price' => 2800,
            'client_price' => 3500,
            'description' => 'Kit de voyages et hotels (Lot de 5 paquets)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
            
        $product = Product::firstOrCreate([
            'name' => 'Snake Oil',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 2,
            'partner_price' => 1800,
            'client_price' => 2500,
            'description' => 'Snake Oil',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
            
        $categorie = CategorieProduct::whereName('SOINS DE SANTÉ')->first();
        $product = Product::firstOrCreate([
            'name' => 'Arthro SupReviver',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 22.5,
            'partner_price' => 16000,
            'client_price' => 18000,
            'description' => 'Arthro SupReviver (60 comprimés)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Calcium',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 13.75,
            'partner_price' => 10000,
            'client_price' => 11000,
            'description' => 'Calcium (100 Comprimés)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Café Cordyceps',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 2.5,
            'partner_price' => 3900,
            'client_price' => 4300,
            'description' => 'Café Cordyceps Militaris boite 10 sachets',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'MENGQIAN FEMME',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 24,
            'partner_price' => 24000,
            'client_price' => 26500,
            'description' => 'MENGQIAN FEMME',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'LIBAO HOMME',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 24,
            'partner_price' => 24000,
            'client_price' => 26500,
            'description' => 'LIBAO HOMME',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Berry Oil',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 33,
            'partner_price' => 22500,
            'client_price' => 25000,
            'description' => 'Berry Oil boite (120 capsules)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Thé MARRON',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 5,
            'partner_price' => 4800,
            'client_price' => 5500,
            'description' => 'Thé Permettant De Reguler la Tension et la Glycemie',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Thé vert',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 5,
            'partner_price' => 4800,
            'client_price' => 5500,
            'description' => 'Thé pour la Détoxification et L\'Entretien',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Thé rose',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 5,
            'partner_price' => 4800,
            'client_price' => 5500,
            'description' => 'Thé Minceur',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Liqueur de vin',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 10,
            'partner_price' => 14000,
            'client_price' => 15400,
            'description' => 'Liqueur Puissant pour la Sante',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
            
        $categorie = CategorieProduct::whereName('SOINS DE SANTÉ HIGH-TECH')->first();
        $product = Product::firstOrCreate([
            'name' => 'Gobelet Alcalin',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 45,
            'partner_price' => 36000,
            'client_price' => 45000,
            'description' => 'Gobelet Alcalin π (400ml)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Filtre Gobelet Alcalin π',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 5,
            'partner_price' => 12000,
            'client_price' => 15000,
            'description' => 'Filtre Gobelet Alcalin π',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Chaussure Aplus',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 45,
            'partner_price' => 70000,
            'client_price' => 75000,
            'description' => 'Chaussure énergetique Aplus',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $categorie = CategorieProduct::whereName('SERVIETTES HYGIÉNIQUE')->first();
        $product = Product::firstOrCreate([
            'name' => 'Serviette Hygiénique Nuit',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 50,
            'partner_price' => 40000,
            'client_price' => 45500,
            'description' => 'Serviette Hygiénique Magnétique (Nuit 19 packs/Carton)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Serviette Hygiénique Jour',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 50,
            'partner_price' => 40000,
            'client_price' => 45500,
            'description' => 'Serviette Hygiénique Magnétique (Jour 19 packs/Carton)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Protège-Slip',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 50,
            'partner_price' => 40000,
            'client_price' => 45500,
            'description' => 'Protège-Slip Magnétique (16 packs/Carton)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product = Product::firstOrCreate([
            'name' => 'Serviette Hygiénique 4en1',
          ], [
            'id' => (string) Str::uuid(),
            'categorie_id' => $categorie->id,
            'point' => 50,
            'partner_price' => 42000,
            'client_price' => 49000,
            'description' => 'Serviette Hygiénique Magnétique (19 packs/Carton 4en1)',
            'fichier_id' => null,
            'user_id' => $user[0],
            'public' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
