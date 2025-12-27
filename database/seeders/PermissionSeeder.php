<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ==============================
        //  Add All Modules Here
        // ==============================
        $modules = [
            'users',
            'roles',
            'permissions',
            'bidders',
            'projects',
            'developers',
            'teams',
            'clients',
            'tasks',
            'leads',
            'invoices',
            'attendance',
            'holidays',
            'departments',
            'reports',
            'settings',
        ];

        // Create CRUD permissions for each module
        foreach ($modules as $module) {
            Permission::firstOrCreate(['name' => "create {$module}"]);
            Permission::firstOrCreate(['name' => "view {$module}"]);
            Permission::firstOrCreate(['name' => "update {$module}"]);
            Permission::firstOrCreate(['name' => "delete {$module}"]);
        }

        // General access level permissions
        $generalPermissions = [
            'access dashboard',
            'manage system',
            'view logs',
            'export data',
        ];

        foreach ($generalPermissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        echo "✔ Permissions Created Successfully\n";
    }
}
