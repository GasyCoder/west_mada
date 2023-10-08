<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {   
        $user = User::create([
            'name' => 'Vato-Be',
            'email' => 'admin@gmail.com',
            'image' => 'default.jpg',
            'is_active' => true,
            'password' => bcrypt('012345678')
        ]);
        $role = Role::find(1);
        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user = User::create([
            'name' => 'BABA',
            'email' => 'baba@gmail.com',
            'image' => 'default.jpg',
            'is_active' => true,
            'password' => bcrypt('012345678')
        ]);
        $role = Role::find(2);
        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
