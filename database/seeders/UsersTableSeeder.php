<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'              => 1,
                'name'            => 'admin',
                'email'           => 'admin@gmail.com',
                'password'        => bcrypt('password'),
            ],
            [
                'id'              => 2,
                'name'            => 'user',
                'email'           => 'user@gmail.com',
                'password'        => bcrypt('password'),
            ],
        ];

        User::insert($users);
    }
}
