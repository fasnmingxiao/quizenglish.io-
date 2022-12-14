<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::find(1);

        $roleDatas = [
            ['name' => 'Admin'],
        ];
        foreach ($roleDatas as $roleData) {
            $role = Role::create($roleData);
            if ($roleData['name'] === 'Admin') {
                $user->assignRole('admin');
            }
        }
    }
}
