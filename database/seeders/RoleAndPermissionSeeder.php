<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    private array $permissions = [
        'User-Browse', 'User-Show', 'User-Edit', 'User-Add', 'User-Delete', 'User-Trash-Recover', 'User-Trash-Remove', 'User-Trash-Empty', 'User-Trash-Restore',

        'Listing-Browse', 'Listing-Show', 'Listing-Edit', 'Listing-Add', 'Listing-Delete', 'Listing-Trash-Recover', 'Listing-Trash-Remove', 'Listing-Trash-Empty', 'Listing-Trash-Restore',

        'Role-Assign', 'Role-Revoke', 'Role-Browse', 'Role-Show', 'Role-Edit', 'Role-Delete'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // generate permissions
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create Administrator role
        $adminRole = Role::create(['name' => 'Administrator']);
        $adminRole->givePermissionTo([
            'User-Browse', 'User-Show', 'User-Edit', 'User-Add', 'User-Delete', 'User-Trash-Recover', 'User-Trash-Remove', 'User-Trash-Empty', 'User-Trash-Restore',

            'Listing-Browse', 'Listing-Show', 'Listing-Edit', 'Listing-Delete', 'Listing-Trash-Recover', 'Listing-Trash-Remove', 'Listing-Trash-Empty', 'Listing-Trash-Restore',

            'Role-Assign', 'Role-Revoke', 'Role-Browse', 'Role-Show', 'Role-Edit', 'Role-Delete'
        ]);

        // create Staff role
        $staffRole = Role::create(['name' => 'Staff']);
        $staffRole->givePermissionTo([
            'User-Browse', 'User-Show', 'User-Edit', 'User-Add', 'User-Delete',

            'Listing-Browse', 'Listing-Show', 'Listing-Edit', 'Listing-Delete', 'Listing-Trash-Recover', 'Listing-Trash-Remove',
        ]);

        // create Client role
        $clientRole = Role::create(['name' => 'Client']);
        $clientRole->givePermissionTo([

            'Listing-Browse', 'Listing-Show', 'Listing-Add'
        ]);
    }
}
