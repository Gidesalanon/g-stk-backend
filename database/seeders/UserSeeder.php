<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
          'lastname' => 'SADMIN',
        ], [
          'id' => (string) Str::uuid(),
            'parent_id' => null,
            'firstname'=>'Super',
          'username' => 'SuperAdmin',
          'public' => rand(0,1),
          'deleted' => rand(0,1),
          'email'=>'super@super.bj',
          'password' => Hash::make('password'),
          'created_at' => now(),
          'updated_at' => now(),
      ]);
      $role = Role::whereName('root')->first();
      $user->assignRole($role);

      $user = User::firstOrCreate([
        'lastname' => 'ADMIN',
      ], [
        'id' => (string) Str::uuid(),
        'parent_id' => null,
        'firstname'=>'Admin',
        'username' => 'Admin',
        'public' => 1,
        'deleted' => 0,
        'email'=>'admin@admin.bj',
        'password' => Hash::make('password'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    $role = Role::whereName('admin')->first();
    $user->assignRole($role);

    $user = User::firstOrCreate([
      'lastname' => 'MANAGER',
    ], [
      'id' => (string) Str::uuid(),
      'parent_id' => null,
      'firstname'=>'DATA',
      'username' => 'DataManager',
      'public' => rand(0,1),
      'deleted' => rand(0,1),
      'email'=>'data@data.bj',
      'password' => Hash::make('password'),
      'created_at' => now(),
      'updated_at' => now(),
    ]);
    $role = Role::whereName('data_manager')->first();
    $user->assignRole($role);

    }
}
