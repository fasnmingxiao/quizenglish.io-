<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'create user'],
            ['name' => 'read user'],
            ['name' => 'update user'],
            ['name' => 'delete user'],
            ['name' => 'set roles'],
            ['name' => 'set permissions'],
            ['name' => 'read topic'],
            ['name' => 'create topic'],
            ['name' => 'update topic'],
            ['name' => 'delete topic'],
            ['name' => 'read category'],
            ['name' => 'create category'],
            ['name' => 'update category'],
            ['name' => 'delete category'],
            ['name' => 'create quiz'],
            ['name' => 'update quiz'],
            ['name' => 'delete quiz'],
            ['name' => 'read quiz'],
            ['name' => 'create question'],
            ['name' => 'update question'],
            ['name' => 'delete question'],
            ['name' => 'read question'],
        ];
        foreach ($permissions as $permission) {
            if (is_null(Permission::where('name', $permission['name'])->first())) {
                Permission::create($permission);
            }
        }
        $role = Role::where('name', 'Admin')->first();
        $role->syncPermissions(Permission::all());
    }
}
