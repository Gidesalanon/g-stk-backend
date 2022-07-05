<?php
namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::firstOrCreate([
            'name' => Role::SUPERADMIN,
        ], [
            'id' => (string) Str::uuid(),
            'display_name' => 'Administrateur Général',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        Role::firstOrCreate([
            'name' => Role::ADMIN,
        ], [
            'id' => (string) Str::uuid(),
            'display_name' => 'Administrateur',
            'created_at'=>now(),
            'updated_at'=>now(),
        ])->givePermissionTo([

        ]);

        Role::firstOrCreate([
            'name' => Role::DATA_MANAGER,
        ], [
            'id' => (string) Str::uuid(),
            'display_name' => 'Gestionnaire de Données',
            'created_at'=>now(),
            'updated_at'=>now(),
        ])->givePermissionTo([

        ]);
    }
}
