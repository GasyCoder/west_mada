<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelperiods;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [

            'super-admin',
            'employe',
            'client',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'stock-list',
            'stock-create',
            'stock-edit',
            'stock-delete',
            'stock-is_active',

            'stock_category-create',
            'stock_category-edit',
            'stock_category-delete',

            'period-create',
            'period-edit',
            'period-delete',
            'period-is_active',

            'task-create',
            'task-edit',
            'task-delete',
            'task-is_active',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-is_active',

            'hotel-list',
            'hotel-create',
            'hotel-edit',
            'hotel-delete',
            'hotel-is_active',

            'type-list',
            'type-create',
            'type-edit',
            'type-delete',

            'service-list',
            'service-create',
            'service-edit',
            'service-delete',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
