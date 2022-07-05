<?php
namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class ProjetPermissionsSeeder extends Seeder
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
            'name' => 'projets.all',
            'display_name' => 'Projets',
            'parent_id' => null
        ]);

        $children = [
            [
                'id' => (string) Str::uuid(),
                'name' => 'view_any projets',
                'display_name' => 'Lister les projets',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'view projets',
                'display_name' => 'Voir les informations d\'un projet',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'create projets',
                'display_name' => 'Créer les projets',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'update projets',
                'display_name' => 'Editer les projets',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'delete projets',
                'display_name' => 'Supprimer les projets ',
                'parent_id' => $parent->id
            ],

        ];

        foreach ($children as $value) {
            Permission::create($value);
        }
    }
}
