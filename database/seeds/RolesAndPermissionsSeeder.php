<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

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

        // create permissions
        Permission::create(['name' => 'create supervisors']);
        Permission::create(['name' => 'edit supervisors']);
        Permission::create(['name' => 'delete supervisors']);

        Permission::create(['name' => 'create editors']);
        Permission::create(['name' => 'edit editors']);
        Permission::create(['name' => 'delete editors']);

        Permission::create(['name' => 'create writers']);
        Permission::create(['name' => 'edit writers']);
        Permission::create(['name' => 'delete writers']);

        Permission::create(['name' => 'create departments']);
        Permission::create(['name' => 'edit departments']);
        Permission::create(['name' => 'delete departments']);

        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign created permissions

        // this can be done as separate statements
        // $role = Role::create(['name' => 'writer']);
        // $role->givePermissionTo('edit articles');

        // or may be done by chaining
        // $role = Role::create(['name' => 'editor'])
        //     ->givePermissionTo(['publish articles', 'unpublish articles']);

        // $role = Role::create(['name' => 'supervisor'])
        //     ->givePermissionTo(['publish articles', 'unpublish articles']);

        $user = Role::create(['name' => 'super_admin']);
        $user->givePermissionTo(Permission::all());

        $user = new User;
        $user->first_name = 'Super';
        $user->last_name = 'Admin';
        $user->email = 'admin@app.com';
        $user->password = Hash::make('123456789');

        $user->assignRole('super_admin');
        $user->save();






    }
}
