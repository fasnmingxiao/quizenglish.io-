<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'first_name' => 'Admin',
            'last_name' => 'Supper',
            'email' => 'admin@localhost',
            'password' => Hash::make('123123123'),
            'role' => '1'
        ]);
    }
}
