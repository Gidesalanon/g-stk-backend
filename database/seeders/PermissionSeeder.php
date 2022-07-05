<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Permissions\UserPermissionsSeeder;
use Database\Seeders\Permissions\EntreprisePermissionsSeeder;
use Database\Seeders\Permissions\ProjetPermissionsSeeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserPermissionsSeeder::class,
            ProjetPermissionsSeeder::class,
            EntreprisePermissionsSeeder::class,
        ]);
    }
}
