<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'admin',
            'manager',
            'hr',
            'team_leader',
            'developer',
            'bidder',
        ];

        // Create roles
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $users = [
            ['name' => 'Admin User',       'email' => 'admin@example.com',       'role' => 'admin'],
            ['name' => 'Manager User',     'email' => 'manager@example.com',     'role' => 'manager'],
            ['name' => 'HR User',          'email' => 'hr@example.com',          'role' => 'hr'],
            ['name' => 'Team Leader User', 'email' => 'teamleader@example.com',  'role' => 'team_leader'],
            ['name' => 'Developer User',   'email' => 'developer@example.com',   'role' => 'developer'],
            ['name' => 'Bidder User',      'email' => 'bidder@example.com',      'role' => 'bidder'],
        ];

        foreach ($users as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make('password'), // default password = password
                ]
            );

            $user->syncRoles($data['role']);
        }
    }
}
