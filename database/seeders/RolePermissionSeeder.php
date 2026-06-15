<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create Roles
        $roles = [
            'super-admin',
            'school-admin',
            'teacher',
            'student',
            'parent',
            'registrar',
            'cashier',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }

        // Create Permissions
        $permissions = [
            'view students',
            'create students',
            'edit students',
            'delete students',

            'view teachers',
            'create teachers',
            'edit teachers',
            'delete teachers',

            'view subjects',
            'create subjects',
            'edit subjects',
            'delete subjects',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::findByName('super-admin');

        $superAdmin->syncPermissions(
            Permission::all()
        );

        // Assign all permissions to Super Admin
        $superAdmin = Role::findByName('super-admin');

        $superAdmin->syncPermissions(Permission::all());

        // School Admin Permissions
        $schoolAdmin = Role::findByName('school-admin');

        $schoolAdmin->syncPermissions([
            'view students',
            'create students',
            'edit students',
            'delete students',

            'view teachers',
            'create teachers',
            'edit teachers',
            'delete teachers',

            'view subjects',
            'create subjects',
            'edit subjects',
            'delete subjects',
        ]);

        // Teacher Permissions
        $teacher = Role::findByName('teacher');

        $teacher->syncPermissions([
            'view students',
            'view subjects',
        ]);
    }
}