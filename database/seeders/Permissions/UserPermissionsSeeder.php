<?php
namespace Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserPermissionsSeeder extends Seeder
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
            'name' => 'users.all',
            'display_name' => 'Utilisateurs',
            'parent_id' => null
        ]);

        $children = [
            [
                'id' => (string) Str::uuid(),
                'name' => 'view_any users',
                'display_name' => 'Lister les utilisateurs',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'view users',
                'display_name' => 'Voir les informations d\'un utilisateur',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'create users',
                'display_name' => 'Créer les utilisateurs',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'update users',
                'display_name' => 'Editer les utilisateurs',
                'parent_id' => $parent->id
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'delete users',
                'display_name' => 'Supprimer les utilisateurs ',
                'parent_id' => $parent->id
            ],

        ];

        foreach ($children as $value) {
            Permission::create($value);
        }
    }
}
