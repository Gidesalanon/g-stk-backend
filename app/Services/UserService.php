<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserService
{
    public function create(array $data)
    {

      //  $data['password'] = str_random(15);

        $user = User::create(array_merge($data, [
            'password' => Hash::make($data['password']),
            'id' => (string) Str::uuid()
        ]));

        $user->syncRoles($data['role_id']);

        return $user;
    }

    public function update(User $user, array $data)
    {



        if (!empty(data_get($data, 'password', false))) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);

        $user->syncRoles($data['role_id']);

        return $user;

    }

    public function delete(User $user)
    {
        //$user->syncRoles([]);
        return $user->delete();
    }

    public function addRole(User $user, Role $role)
    {
        $user->assignRole($role);
        return $user;
    }
}
