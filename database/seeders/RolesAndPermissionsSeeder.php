<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
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

        // Create permissions for Products
        Permission::create(['name' => 'show product']);
        Permission::create(['name' => 'add product']);
        Permission::create(['name' => 'edit every product']);
        Permission::create(['name' => 'edit my product']);
        Permission::create(['name' => 'delete every product']);
        Permission::create(['name' => 'delete my product']);

        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => 'vendor'])
            ->givePermissionTo(
                'add product',
                'edit my product',
                'delete my product'
            );

//        Role::create(['name' => 'user'])
//            ->givePermissionsTo(
//                'show product'
//            );
    }
}
