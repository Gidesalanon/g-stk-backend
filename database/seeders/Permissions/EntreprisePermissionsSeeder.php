<?php
namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class EntreprisePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Permission::create([
            'id' => (string) Str::uuid(),
            'name' => 'entreprises.all',
            'display_name' => 'Entreprises',
            'parent_id' => null
        ]);

        $children = [
            [
                'id' => (string) Str::uuid(),
                'name' => 'view_any s',
                'display_name' => 'Lister les partenaires',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'view entreprises',
                'display_name' => 'Voir les informations d\'un partenaire',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'create entreprises',
                'display_name' => 'Créer les partenaires',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'update entreprises',
                'display_name' => 'Editer les partenaires',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'delete entreprises',
                'display_name' => 'Supprimer les partenaires ',
                'parent_id' => $parent->id
            ],

        ];

        foreach ($children as $value) {
            Permission::create($value);
        }
    }
}
